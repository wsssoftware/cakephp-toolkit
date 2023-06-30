<?php
declare(strict_types=1);

namespace Toolkit\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\EventManager;
use Cake\Routing\Router;
use Cake\View\JsonView;
use Toolkit\ApexCharts\ApexChart;
use Toolkit\View\ApexChartsView;

/**
 * ApexChars component
 */
class ApexChartsComponent extends Component
{

    /**
     * @var ApexChart[]
     */
    protected array $_chartsConfigs = [];

    /**
     * @inheritDoc
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
        EventManager::instance()->on(
            'Controller.beforeRender',
            function ()
            {
                $this->getController()->set('_chartsConfigs', $this->_chartsConfigs);
                $this->_setAjaxData();
            }
        );
    }

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function setChart(ApexChart $apexCharts): void
    {
        $apexCharts->configure();
        $this->_chartsConfigs[$apexCharts->getId()] = $apexCharts;
    }

    /**
     * @return void
     */
    private function _setAjaxData(): void
    {
        if (!empty($this->getController()->getRequest()->getHeader('apexChartsUpdate'))) {
            $_apexCharts = [];
            foreach ($this->_chartsConfigs as $chartsConfig) {
                $_apexCharts[$chartsConfig->getId()] = $chartsConfig->getData();
            }
            $this->getController()->set('_apexChartItem', $_apexCharts);
            $this->getController()->viewBuilder()->setOption('serialize', '_apexChartItem');
            $this->getController()->viewBuilder()->setClassName(ApexChartsView::class);
        }
    }
}
