<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait PlotOptionsBarTrait
{

    /**
     * This option will turn a column chart into a horizontal bar chart.
     *
     * @param bool $horizontal
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarHorizontal(bool $horizontal): self
    {
        $this->setConfig('plotOptions.bar.horizontal', $horizontal);

        return $this;
    }

    /**
     * Rounded corners around the bars/columns
     *
     * @param int $borderRadius
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarBorderRadius(int $borderRadius): self
    {
        $this->setConfig('plotOptions.bar.borderRadius', $borderRadius);

        return $this;
    }

    /**
     * In column charts, columnWidth is the percentage of the available width in the grid-rect.
     * Accepts ‘0%’ to ‘100%’
     *
     * @param string $columnWidth
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarColumnWidth(string $columnWidth): self
    {
        $this->setConfig('plotOptions.bar.columnWidth', $columnWidth);

        return $this;
    }

    /**
     * In horizontal bar charts, barHeight is the percentage of the available height in the grid-rect.
     * Accepts ‘0%’ to ‘100%’
     *
     * @param string $barHeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarBarHeight(string $barHeight): self
    {
        $this->setConfig('plotOptions.bar.barHeight', $barHeight);

        return $this;
    }

    /**
     * Turn this option to make the bars discrete. Each value indicates one bar per series.
     *
     * @param bool $distributed
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarDistributed(bool $distributed): self
    {
        $this->setConfig('plotOptions.bar.distributed', $distributed);

        return $this;
    }

    /**
     * In a rangeBar / timeline chart, the bars should overlap over each other instead of stacking if this option is enabled.
     *
     * @param bool $rangeBarOverlap
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarRangeBarOverlap(bool $rangeBarOverlap): self
    {
        $this->setConfig('plotOptions.bar.rangeBarOverlap', $rangeBarOverlap);

        return $this;
    }

    /**
     * In a multi-series rangeBar / timeline chart, group rows (horizontal bars)
     * together instead of stacking up. Helpful when there are no overlapping rows but distinct values.
     *
     * @param bool $rangeBarGroupRows
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarRangeBarGroupRows(bool $rangeBarGroupRows): self
    {
        $this->setConfig('plotOptions.bar.rangeBarGroupRows', $rangeBarGroupRows);

        return $this;
    }

    /**
     * Value indicating range’s upper limit
     *
     * @param int $from
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarColorsRangesFrom(int $from): self
    {
        $this->setConfig('plotOptions.bar.colors.ranges.from', $from);

        return $this;
    }

    /**
     * Value indicating range’s lower limit
     *
     * @param int $to
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarColorsRangesTo(int $to): self
    {
        $this->setConfig('plotOptions.bar.colors.ranges.to', $to);

        return $this;
    }

    /**
     * Color to fill the range with
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarColorsRangesColor(string $color): self
    {
        $this->setConfig('plotOptions.bar.colors.ranges.color', $color);

        return $this;
    }

    /**
     * Custom colors for background rects. The number of colors in the array is repeated if less colors than data-points are specified.
     *
     * @param array $backgroundBarColors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarColorsBackgroundBarColors(array $backgroundBarColors): self
    {
        foreach ($backgroundBarColors as $backgroundBarColor) {
            Colors::validateColorOrFail($backgroundBarColor);
        }
        $this->setConfig('plotOptions.bar.colors.backgroundBarColors', $backgroundBarColors);

        return $this;
    }

    /**
     * Opacity for background colors of the bar
     *
     * @param float $backgroundBarOpacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarColorsBackgroundBarOpacity(float $backgroundBarOpacity): self
    {
        $this->setConfig('plotOptions.bar.colors.backgroundBarOpacity', $backgroundBarOpacity);

        return $this;
    }

    /**
     * Border radius for background rect of the bar
     *
     * @param int $backgroundBarRadius
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarColorsBackgroundBarRadius(int $backgroundBarRadius): self
    {
        $this->setConfig('plotOptions.bar.colors.backgroundBarRadius', $backgroundBarRadius);

        return $this;
    }

    /**
     * Available Options:
     *  - top
     *  - center
     *  - bottom
     *
     * @param string $position
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarDataLabelsPosition(string $position): self
    {
        $valid = ['top', 'center', 'bottom'];
        if (!in_array($position, $valid)) {
            throw new ApexChartWrongOptionException('plotOptions.bar.dataLabels.position', $position, $valid);
        }
        $this->setConfig('plotOptions.bar.dataLabels.position', $position);

        return $this;
    }

    /**
     * Available Options:
     *  - horizontal
     *  - `vertical
     *
     * @param string $orientation
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarDataLabelsOrientation(string $orientation): self
    {
        $valid = ['horizontal', 'vertical'];
        if (!in_array($orientation, $valid)) {
            throw new ApexChartWrongOptionException('plotOptions.bar.dataLabels.position', $orientation, $valid);
        }
        $this->setConfig('plotOptions.bar.dataLabels.orientation', $orientation);

        return $this;
    }

    /**
     * AMaximum limit of data-labels that can be displayed on a bar chart. If data-points exceed this number, data-labels won’t be shown.
     *
     * @param int $maxItems
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarDataLabelsMaxItems(int $maxItems): self
    {
        $this->setConfig('plotOptions.bar.dataLabels.maxItems', $maxItems);

        return $this;
    }

    /**
     * When there are values that are very close to one another, this property prevents it by hiding overlapping labels.
     *
     * @note This affects only stacked charts
     * @param bool $hideOverflowingLabels
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBarTrait
     */
    public function setPlotOptionsBarDataLabelsHideOverflowingLabels(bool $hideOverflowingLabels): self
    {
        $this->setConfig('plotOptions.bar.dataLabels.hideOverflowingLabels', $hideOverflowingLabels);

        return $this;
    }
}