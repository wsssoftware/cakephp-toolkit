<?php
declare(strict_types = 1);

namespace Toolkit\View\Helper;

use Cake\View\Helper;
use Cake\View\StringTemplateTrait;
use Toolkit\View\Helper\Traits\B5ButtonsTrait;

/**
 * B5 helper
 */
class B5Helper extends Helper
{
    use StringTemplateTrait;
    use B5ButtonsTrait;

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'templates' => [
            'btnGroup' => '<div class="btn-group{{size}}" role="group" aria-label="{{aria}}">{{content}}</div>',
        ],
    ];

    /**
     * @inheritDoc
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->Html = $this->getView()->Html;
    }

}
