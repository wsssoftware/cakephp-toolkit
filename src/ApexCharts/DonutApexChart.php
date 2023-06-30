<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts;


abstract class DonutApexChart extends PieApexChart
{
    /**
     * @inheritDoc
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->setChartType('donut');
    }
}