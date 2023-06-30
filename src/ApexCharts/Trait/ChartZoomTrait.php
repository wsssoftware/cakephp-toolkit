<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;

trait ChartZoomTrait
{

    /**
     * To allow zooming in axis charts.
     *
     * @note: In a category x-axis chart, to enable zooming, you will also need to set xaxis.tickPlacement: 'on'.
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartZoomTrait
     */
    public function setChartZoomEnabled(bool $enabled): self
    {
        $this->setConfig('chart.zoom.enabled', $enabled);

        return $this;
    }

    /**
     * Allow zooming either on both x-axis, y-axis or on both axis.
     * Available options:
     *  - x
     *  - y
     *  - xy
     *
     * @note Known Issue: In synchronized charts, xy or y will not update charts in sync, while x will work correctly.
     * @param string $type
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartZoomTrait
     */
    public function setChartZoomType(string $type): self
    {
        $valid = ['x', 'y', 'xy'];
        if (!in_array($type, $valid)) {
            throw new ApexChartWrongOptionException('chart.zoom.type', $type, $valid);
        }
        $this->setConfig('chart.zoom.type', $type);

        return $this;
    }

    /**
     * When this option is turned on, the chart’s y-axis re-scales to a new low and high based on the visible area. Helpful in situations where the user zoomed in to a small area to get a better view.
     *
     * @note Known Issue: This option doesn’t work in a multi-axis chart (when you have more than 1 y-axis)
     * @param bool $autoScaleYaxis
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartZoomTrait
     */
    public function setChartZoomAutoScaleYaxis(bool $autoScaleYaxis): self
    {
        $this->setConfig('chart.zoom.autoScaleYaxis', $autoScaleYaxis);

        return $this;
    }

    /**
     * Background color of the selection zoomed area
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartZoomTrait
     */
    public function setChartZoomZoomedAreaFillColor(string $color): self
    {
        $this->setConfig('chart.zoom.zoomedArea.fill.color', $color);

        return $this;
    }

    /**
     * Sets the transparency level of the selection fill
     *
     * @param float $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartZoomTrait
     */
    public function setChartZoomZoomedAreaFillOpacity(float $opacity): self
    {
        $this->setConfig('chart.zoom.zoomedArea.fill.opacity', $opacity);

        return $this;
    }

    /**
     * Border color of the selection zoomed area
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartZoomTrait
     */
    public function setChartZoomZoomedAreaStrokeColor(string $color): self
    {
        $this->setConfig('chart.zoom.zoomedArea.stroke.color', $color);

        return $this;
    }

    /**
     * Sets the transparency level of the selection border
     *
     * @param float $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartZoomTrait
     */
    public function setChartZoomZoomedAreaStrokeOpacity(float $opacity): self
    {
        $this->setConfig('chart.zoom.zoomedArea.stroke.opacity', $opacity);

        return $this;
    }

    /**
     * Sets the width selection border
     *
     * @param int $width
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartZoomTrait
     */
    public function setChartZoomZoomedAreaStrokeWidth(int $width): self
    {
        $this->setConfig('chart.zoom.zoomedArea.stroke.width', $width);

        return $this;
    }

}