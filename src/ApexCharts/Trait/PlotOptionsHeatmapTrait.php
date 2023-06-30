<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait PlotOptionsHeatmapTrait
{

    /**
     * Radius of the rectangle inside heatmap
     *
     * @param int $radius
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapRadius(int $radius): self
    {
        $this->setConfig('plotOptions.heatmap.radius', $radius);

        return $this;
    }

    /**
     * Enable different shades of color depending on the value
     *
     * @param bool $enableShades
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapEnableShades(bool $enableShades): self
    {
        $this->setConfig('plotOptions.heatmap.enableShades', $enableShades);

        return $this;
    }

    /**
     * The intensity of the shades generated for each value
     * Accepts from 0 to 1
     *
     * @param float $shadeIntensity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapShadeIntensity(float $shadeIntensity): self
    {
        $this->setConfig('plotOptions.heatmap.shadeIntensity', $shadeIntensity);

        return $this;
    }

    /**
     * When enabled, it will reverse the shades for negatives but keep the positive shades as it is now.
     * An example of such use-case would be in a profit/loss chart where darker reds mean larger losses, darker greens mean larger gains.
     *
     * @param bool $reverseNegativeShade
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapReverseNegativeShade(bool $reverseNegativeShade): self
    {
        $this->setConfig('plotOptions.heatmap.reverseNegativeShade', $reverseNegativeShade);

        return $this;
    }

    /**
     * When turned on, each row in a heatmap will have it’s own lowest
     * and highest range and colors will be shaded for each series. Default value is turned off.
     *
     * @param bool $distributed
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapDistributed(bool $distributed): self
    {
        $this->setConfig('plotOptions.heatmap.distributed', $distributed);

        return $this;
    }

    /**
     * If turned on, the stroke/border around the heatmap cell has the same color as the cell color.
     *
     * @param bool $useFillColorAsStroke
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapUseFillColorAsStroke(bool $useFillColorAsStroke): self
    {
        $this->setConfig('plotOptions.heatmap.useFillColorAsStroke', $useFillColorAsStroke);

        return $this;
    }

    /**
     * Value indicating range’s upper limit
     *
     * @param int $from
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapColorScaleRangesFrom(int $from): self
    {
        $this->setConfig('plotOptions.heatmap.colorScale.ranges.from', $from);

        return $this;
    }

    /**
     * Value indicating range’s lower limit
     *
     * @param int $to
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapColorScaleRangesTo(int $to): self
    {
        $this->setConfig('plotOptions.heatmap.colorScale.ranges.to', $to);

        return $this;
    }

    /**
     * Background color to fill the range with.
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapColorScaleRangesColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('plotOptions.heatmap.colorScale.ranges.color', $color);

        return $this;
    }

    /**
     * Fore Color of the text if data-labels is enabled.
     *
     * @param string $foreColor
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapColorScaleRangesForeColor(string $foreColor): self
    {
        Colors::validateColorOrFail($foreColor);
        $this->setConfig('plotOptions.heatmap.colorScale.ranges.foreColor', $foreColor);

        return $this;
    }

    /**
     * If a name is provided, it will be used in the legend. If it is not provided, the text falls back to {from} - {to}
     *
     * @param string $name
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapColorScaleRangesName(string $name): self
    {
        $this->setConfig('plotOptions.heatmap.colorScale.ranges.name', $name);

        return $this;
    }

    /**
     * In a multiple series heatmap, flip the color-scale to fill the heatmaps vertically instead of horizontally.
     *
     * @param bool $inverse
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapColorScaleInverse(bool $inverse): self
    {
        $this->setConfig('plotOptions.heatmap.colorScale.inverse', $inverse);

        return $this;
    }

    /**
     * Specify the lower range for heatmap color calculation.
     *
     * @param int $min
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapColorScaleMin(int $min): self
    {
        $this->setConfig('plotOptions.heatmap.colorScale.min', $min);

        return $this;
    }

    /**
     * Specify the higher range for heatmap color calculation.
     *
     * @param int $max
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait
     */
    public function setPlotOptionsHeatmapColorScaleMax(int $max): self
    {
        $this->setConfig('plotOptions.heatmap.colorScale.max', $max);

        return $this;
    }

}