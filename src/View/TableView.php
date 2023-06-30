<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.0.4
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Toolkit\View;

use Cake\Core\Configure;
use Cake\Event\EventManager;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\View\View;
use RuntimeException;

/**
 * A view class that is used for AJAX responses.
 * Currently only switches the default layout and sets the response type -
 * which just maps to text/html by default.
 */
class TableView extends View
{

    /**
     * Response type.
     *
     * @var string
     */
    protected $_responseType = 'json';

    /**
     * Default config options.
     *
     * Use ViewBuilder::setOption()/setOptions() in your controller to set these options.
     *
     * - `serialize`: Option to convert a set of view variables into a serialized response.
     *   Its value can be a string for single variable name or array for multiple
     *   names. If true all view variables will be serialized. If null or false
     *   normal view template will be rendered.
     * - `jsonOptions`: Options for json_encode(). For e.g. `JSON_HEX_TAG | JSON_HEX_APOS`.
     * - `jsonp`: Enables JSONP support and wraps response in callback function provided in query string.
     *   - Setting it to true enables the default query string parameter "callback".
     *   - Setting it to a string value, uses the provided query string parameter
     *     for finding the JSONP callback name.
     *
     * @var array
     * @pslam-var array{serialize:string|bool|null, jsonOptions: int|null, jsonp: bool|string|null}
     */
    protected $_defaultConfig = [
        'serialize' => null,
        'jsonOptions' => null,
        'jsonp' => null,
    ];

    /**
     * @var \Cake\View\View
     */
    protected View $_appView;

    /**
     * @inheritDoc
     */
    public function __construct(?ServerRequest $request = null, ?Response $response = null, ?EventManager $eventManager = null, array $viewOptions = []) {
        parent::__construct($request, $response, $eventManager, $viewOptions);

        $appViewFqn = Configure::read('App.namespace') . "\\View\\AppView";
        $this->_appView = new $appViewFqn($request, $response, $eventManager, $viewOptions);
        foreach ($this->_appView->helpers()->getIterator() as $key => $helper) {
            /** @var \Cake\View\Helper $helper */
            if (empty($this->{$key})) {
                $this->{$key} = $helper;
            }
        }
    }

    /**
     * Render a JSON view.
     *
     * @param string|null $template The template being rendered.
     * @param string|false|null $layout The layout being rendered.
     * @return string The rendered view.
     */
    public function render(?string $template = null, $layout = null): string
    {
        return $this->_serialize(['_tableConfigs']);
    }

    /**
     * @inheritDoc
     */
    protected function _serialize($serialize): string
    {
        $data = $this->_dataToSerialize($serialize);
        if (!empty($data['_tableConfigs'])) {
            $this->_setRenderedTable($data);
        }

        $jsonOptions = $this->getConfig('jsonOptions');
        if ($jsonOptions === null) {
            $jsonOptions = JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_PARTIAL_OUTPUT_ON_ERROR;
        } elseif ($jsonOptions === false) {
            $jsonOptions = 0;
        }

        if (Configure::read('debug')) {
            $jsonOptions |= JSON_PRETTY_PRINT;
        }

        if (defined('JSON_THROW_ON_ERROR')) {
            $jsonOptions |= JSON_THROW_ON_ERROR;
        }

        $return = json_encode($data, $jsonOptions);
        if ($return === false) {
            throw new RuntimeException(json_last_error_msg(), json_last_error());
        }

        return $return;
    }
    
    protected function _setRenderedTable(array &$data): void
    {
        /** @var \Toolkit\Tables\AbstractTable[] $tableConfigs */
        $tableConfigs = $data['_tableConfigs'];
        unset($data['_tableConfigs']);
        $data['tables'] = [];
        foreach ($tableConfigs as $key => $tableConfig) {
            $data['tables'][$key]['id'] = $tableConfig->getRepository()->getAlias() . 'Table';
            $data['tables'][$key]['body'] = $this->Tables->renderTable($tableConfig->getRepository()->getAlias());
        }
    }

    /**
     * Returns data to be serialized.
     *
     * @param array|string $serialize The name(s) of the view variable(s) that need(s) to be serialized.
     * @return mixed The data to serialize.
     */
    protected function _dataToSerialize($serialize)
    {
        if (is_array($serialize)) {
            $data = [];
            foreach ($serialize as $alias => $key) {
                if (is_numeric($alias)) {
                    $alias = $key;
                }
                if (array_key_exists($key, $this->viewVars)) {
                    $data[$alias] = $this->viewVars[$key];
                }
            }

            return !empty($data) ? $data : null;
        }

        return $this->viewVars[$serialize] ?? null;
    }
}
