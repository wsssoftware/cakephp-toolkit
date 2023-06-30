<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


trait ChartBrushTrait
{

    /**
     * Turn on this option to enable brush chart options
     * After you enable brush, you need to set target chart ID to allow the brush chart to capture events on the target chart.
     *
     * @note One important configuration to set in a brush chart is the chart.selection option. The range which you set in chart.selection will act as brush in the brush chart
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartBrushTrait
     */
    public function setChartBrushEnabled(bool $enabled): self
    {
        $this->setConfig('chart.brush.enabled', $enabled);

        return $this;
    }

    /**
     * Chart ID of the target chart to sync the brush chart and the target chart.
     *
     * @param string $target
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartBrushTrait
     */
    public function setChartBrushTarget(string $target): self
    {
        $this->setConfig('chart.brush.target', $target);

        return $this;
    }

    /**
     * If set to true, the Y-axis will automatically scale based on the visible min/max range
     *
     * @param bool $autoScaleYaxis
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartBrushTrait
     */
    public function setChartBrushAutoScaleYaxis(bool $autoScaleYaxis): self
    {
        $this->setConfig('chart.brush.autoScaleYaxis', $autoScaleYaxis);

        return $this;
    }

}