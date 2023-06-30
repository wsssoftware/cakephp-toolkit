<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Cake\Error\FatalErrorException;
use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait ChartSelectionTrait
{

    /**
     * To allow selection in axis charts.
     * Selection will not be enabled for category x-axis charts, but only for charts having numeric x-axis. For eg., timeline charts.
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartSelectionTrait
     */
    public function setChartSelectionEnabled(bool $enabled): self
    {
        $this->setConfig('chart.selection.enabled', $enabled);

        return $this;
    }

    /**
     * Allow selection either on both x-axis, y-axis or on both axis.
     * Available options:
     *  - x
     *  - y
     *  - xy
     *
     * @param string $type
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartSelectionTrait
     */
    public function setChartSelectionType(string $type): self
    {
        $valid = ['x', 'y', 'xy'];
        if (!in_array($type, $valid)) {
            throw new ApexChartWrongOptionException('chart.selection.type', $type, $valid);
        }
        $this->setConfig('chart.selection.type', $type);

        return $this;
    }

    /**
     * Background color of the selection rect which is drawn when user drags on the chart.
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartSelectionTrait
     */
    public function setChartFillColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('chart.selection.fill.color', $color);

        return $this;
    }

    /**
     * Opacity of background color of the selection rect.
     *
     * @param float $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartSelectionTrait
     */
    public function setChartFillOpacity(float $opacity): self
    {
        $this->setConfig('chart.selection.fill.opacity', $opacity);

        return $this;
    }

    /**
     * Border thickness of the selection rect.
     *
     * @param int $width
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartSelectionTrait
     */
    public function setChartStrokeWidth(int $width): self
    {
        $this->setConfig('chart.selection.stroke.width', $width);

        return $this;
    }

    /**
     * Creates dashes in borders of svg path. Higher number creates more space between dashes in the border.
     *
     * @param int $dashArray
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartSelectionTrait
     */
    public function setChartStrokeDashArray(int $dashArray): self
    {
        $this->setConfig('chart.selection.stroke.dashArray', $dashArray);

        return $this;
    }

    /**
     * Colors of selection border.
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartSelectionTrait
     */
    public function setChartStrokeColor(string $color): self
    {
        $this->setConfig('chart.selection.stroke.color', $color);

        return $this;
    }

    /**
     * Opacity of selection border.
     *
     * @param float $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartSelectionTrait
     */
    public function setChartStrokeOpacity(float $opacity): self
    {
        $this->setConfig('chart.selection.stroke.opacity', $opacity);

        return $this;
    }

    /**
     * Start value of x-axis. For a time-series chart, a timestamp should be provided
     *
     * @param int $min
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartSelectionTrait
     */
    public function setChartXaxisMin(int $min): self
    {
        $this->setConfig('chart.selection.xaxis.min', $min);

        return $this;
    }

    /**
     * End value of x-axis. For a time-series chart, a timestamp should be provided.
     *
     * @param int $max
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartSelectionTrait
     */
    public function setChartXaxisMax(int $max): self
    {
        $this->setConfig('chart.selection.xaxis.max', $max);

        return $this;
    }

    /**
     * Start value of y-axis. (if used in a multiple y-axes chart, this considers the 1st y-axis).
     *
     * @param int $min
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartSelectionTrait
     */
    public function setChartYaxisMin(int $min): self
    {
        $this->setConfig('chart.selection.yaxis.min', $min);

        return $this;
    }

    /**
     * End value of y-axis (if used in a multiple y-axes chart, this considers the 1st y-axis).
     *
     * @param int $max
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartSelectionTrait
     */
    public function setChartYaxisMax(int $max): self
    {
        $this->setConfig('chart.selection.yaxis.max', $max);

        return $this;
    }


}