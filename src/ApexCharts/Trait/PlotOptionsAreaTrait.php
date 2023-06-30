<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;

trait PlotOptionsAreaTrait
{

    /**
     * When negative values are present in the area chart,
     * this option fill the area either from 0 (origin) or from the end of the chart as illustrated below.
     * Available options:
     *  - origin
     *  - end
     *
     * @param string $fillTo
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsAreaTrait
     */
    public function setPlotOptionsAreaFillTo(string $fillTo): self
    {
        $valid = ['origin', 'end'];
        if (!in_array($fillTo, $valid)) {
            throw new ApexChartWrongOptionException('plotOptions.area.fillTo', $fillTo, $valid);
        }
        $this->setConfig('plotOptions.area.fillTo', $fillTo);

        return $this;
    }
}