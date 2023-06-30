<?php
declare(strict_types=1);

namespace Toolkit\View\Helper;

use Cake\Core\Configure;
use Cake\Error\FatalErrorException;
use Cake\Routing\Router;
use Cake\View\Helper;
use Toolkit\Websocket\WebSocketConfigurationInterface;
use Toolkit\Websocket\WebSocketConfiguration;

/**
 * WebSocket helper
 * @property \Cake\View\Helper\HtmlHelper $Html
 */
class WebSocketHelper extends Helper
{

    protected $helpers = ['Html'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * @var \Toolkit\Websocket\WebSocketConfiguration
     */
    protected WebSocketConfiguration $webSocketConfiguration;


    /**
     * @inheritDoc
     */
    public function initialize(array $config): void
    {
        $namespace = Configure::read('App.namespace');
        $applicationFQN = "$namespace\\Application";

        $hasWebSocketInterfaceImplementation = false;
        foreach (class_implements($applicationFQN) as $classImplement) {
            if ($classImplement === WebSocketConfigurationInterface::class) {
                $hasWebSocketInterfaceImplementation = true;
                break;
            }
        }
        if ($hasWebSocketInterfaceImplementation === false) {
            throw new FatalErrorException(sprintf('The "%s" must to implements the "%s"', $applicationFQN, WebSocketConfigurationInterface::class));
        }
        /** @var WebSocketConfigurationInterface $app */
        $app = new $applicationFQN(CONFIG);
        $this->webSocketConfiguration = $app->setupWebSocketConfiguration(new WebSocketConfiguration());
    }

    /**
     * @param string $application
     * @return string
     */
    public function connect(string $application): string
    {
        $request = $this->getView()->getRequest();

        $proxy = $this->webSocketConfiguration->getProxy();
        if ($proxy !== false) {
            $script = sprintf(
                "Toolkit.webSocket.connect('%s://%s/%s', '%s', '%s', '%s', %s);",
                $this->webSocketConfiguration->getWebSocketProtocol()->getProtocol(),
                $this->webSocketConfiguration->getHttpHost(),
                $proxy,
                $application,
                $request->getSession()->id(),
                json_encode(Router::parseRequest($request)),
                Configure::read('debug') ? 'true' : 'false'
            );
        } else {
            $script = sprintf(
                "Toolkit.webSocket.connect('%s://%s:%s', '%s', '%s', '%s', %s);",
                $this->webSocketConfiguration->getWebSocketProtocol()->getProtocol(),
                $this->webSocketConfiguration->getHttpHost(),
                $this->webSocketConfiguration->getPort(),
                $application,
                $request->getSession()->id(),
                json_encode(Router::parseRequest($request)),
                Configure::read('debug') ? 'true' : 'false'
            );
        }

        return $this->Html->scriptBlock($script, ['type' => 'text/javascript']);
    }

}
