<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts;


abstract class PieApexChart extends ApexChart
{

    /**
     * @inheritDoc
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->setChartType('pie');
        $this->setRenderSeriesEmpty(true);
    }

    /**
     * @param string $label
     * @param int|float $value
     */
    protected function appendData(string $label, int|float $value): void
    {
        $this->addLabel($label);
        $this->addSerieNumeric($value);

    }
}