<?php
declare(strict_types=1);

namespace Toolkit\View\Helper;

use Cake\Error\FatalErrorException;
use Cake\View\Helper;
use Cake\View\StringTemplateTrait;
use Toolkit\ApexCharts\ApexChart;

/**
 * ApexChars helper
 */
class ApexChartsHelper extends Helper
{

    use StringTemplateTrait;

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'templates' => [],
    ];

    /**
     * @var \Toolkit\ApexCharts\ApexChart[]
     */
    protected array $_chartsConfigs;

    /**
     * @var bool
     */
    protected bool $_isSetRefreshTime = false;

    /**
     * @inheritDoc
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->_chartsConfigs = $this->getView()->get('_chartsConfigs', []);
    }

    /**
     * @param string $class
     * @param string|null $id
     * @return \Toolkit\ApexCharts\ApexChart
     */
    public function getChartConfig(string $class, ?string $id): ApexChart
    {
        if (!class_exists($class)) {
            throw new FatalErrorException(sprintf('Provided "%s" class don\'t exists', $class));
        }
        if (!method_exists($class, 'generateId')) {
            throw new FatalErrorException('Provided class don\'t have the generateId method');
        }

        $chartId = $class::generateId($id);
        if (empty($this->_chartsConfigs[$chartId])) {
            throw new FatalErrorException('Apex Chart config not found');
        }

        return $this->_chartsConfigs[$chartId];
    }

    /**
     * @param string $class
     * @param string|null $id
     * @return string
     */
    public function render(string $class, string $id = null): string
    {
        $apexChart = $this->getChartConfig($class, $id);

        $lastKey = array_key_last($this->_chartsConfigs);
        $lastItem = false;
        if ($lastKey === $apexChart->getId()) {
            $lastItem = true;
        }

        $refreshTime = false;
        if ($this->_isSetRefreshTime === false) {
            $refreshTime = ApexChart::getRefreshTime();
            $this->_isSetRefreshTime = true;
        }
        return $this->getView()->element('Toolkit.apex_chart', compact('apexChart', 'refreshTime', 'lastItem'));
    }

}
