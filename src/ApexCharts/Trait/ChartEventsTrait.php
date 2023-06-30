<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Cake\Error\FatalErrorException;
use JetBrains\PhpStorm\Pure;
use Toolkit\Utilities\Colors;

trait ChartEventsTrait
{

    /**
     * Fires when the chart’s initial animation is finished
     *
     * @note Available params: chartContext, options
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsAnimationEnd(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.animationEnd',
            $this->_buildJsFunction($functionBody, ['chartContext', 'options'])
        );

        return $this;
    }

    /**
     * Fires before the chart has been drawn on screen
     *
     * @note Available params: chartContext, config
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsBeforeMount(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.beforeMount',
            $this->_buildJsFunction($functionBody, ['chartContext', 'config'])
        );

        return $this;
    }

    /**
     * Fires after the chart has been drawn on screen
     *
     * @note Available params: chartContext, config
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsMount(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.mounted',
            $this->_buildJsFunction($functionBody, ['chartContext', 'config'])
        );

        return $this;
    }

    /**
     * Fires when the chart has been dynamically updated either with updateOptions() or updateSeries() functions
     *
     * @note Available params: chartContext, config
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsUpdated(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.updated',
            $this->_buildJsFunction($functionBody, ['chartContext', 'config'])
        );

        return $this;
    }

    /**
     * Fires when user clicks on any area of the chart.
     *
     * @note Available params: event, chartContext, config
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsClick(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.click',
            $this->_buildJsFunction($functionBody, ['event', 'chartContext', 'config'])
        );

        return $this;
    }

    /**
     * Fires when user moves mouse on any area of the chart.
     *
     * @note Available params: event, chartContext, config
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsMouseMove(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.mouseMove',
            $this->_buildJsFunction($functionBody, ['event', 'chartContext', 'config'])
        );

        return $this;
    }

    /**
     * Fires when user clicks on legend.
     *
     * @note Available params: chartContext, seriesIndex, config
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsLegendClick(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.legendClick',
            $this->_buildJsFunction($functionBody, ['chartContext', 'seriesIndex', 'config'])
        );

        return $this;
    }

    /**
     * Fires when user clicks on the markers.
     *
     * @note Available params: event, chartContext, {seriesIndex, dataPointIndex, config}
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsMarkerClick(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.markerClick',
            $this->_buildJsFunction($functionBody, ['event', 'chartContext', '{seriesIndex', 'dataPointIndex', 'config}'])
        );

        return $this;
    }

    /**
     * Fires when user selects rect using the selection tool.
     * The second argument contains the yaxis and xaxis coordinates where user made the selection
     *
     * @note Available params: chartContext, {xaxis, config}
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsSelection(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.selection',
            $this->_buildJsFunction($functionBody, ['chartContext', '{xaxis', 'config}'])
        );

        return $this;
    }

    /**
     * Fires when user clicks on a datapoint (bar/column/marker/bubble/donut-slice).
     * The third argument, in addition to the config object, also includes additional information like which dataPointIndex was selected of which series.
     * If you have allowMultipleDataPointsSelection enabled, the third argument includes selectedDataPoints property to get all selected dataPoints.
     *
     * @note When using in line/area charts, this event requires tooltip.intersect: true & tooltip.shared: false along with markers.size has to be greater than 0.
     *
     * @note Available params: event, chartContext, config
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsDataPointSelection(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.dataPointSelection',
            $this->_buildJsFunction($functionBody, ['event', 'chartContext', 'config'])
        );

        return $this;
    }

    /**
     * Fires when user’s mouse enter on a datapoint (bar/column/marker/bubble/donut-slice).
     * The third argument, in addition to the config object, also includes additional information like which dataPointIndex was hovered of particular series.
     *
     * @note When using in line/area charts, this event requires tooltip.intersect: true & tooltip.shared: false along with markers.size has to be greater than 0
     *
     * @note Available params: event, chartContext, config
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsDataPointMouseEnter(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.dataPointMouseEnter',
            $this->_buildJsFunction($functionBody, ['event', 'chartContext', 'config'])
        );

        return $this;
    }

    /**
     * MouseLeave event for a datapoint (bar/column/marker/bubble/donut-slice).
     *
     * @note Available params: event, chartContext, config
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsDataPointMouseLeave(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.dataPointMouseLeave',
            $this->_buildJsFunction($functionBody, ['event', 'chartContext', 'config'])
        );

        return $this;
    }

    /**
     * This function, if defined, runs just before zooming in/out of the chart allowing you to set a custom range for zooming in/out.
     *
     * @note Available params: chartContext, {xaxis}
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsBeforeZoom(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.beforeZoom',
            $this->_buildJsFunction($functionBody, ['chartContext', '{xaxis}'])
        );

        return $this;
    }

    /**
     * This function, if defined, runs just before the user hits the HOME button on the toolbar to reset the chart to it’s original state.
     * The function allows you to set a custom axes range for the initial view of the chart.
     *
     * @note Available params: chartContext, opts
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsBeforeResetZoom(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.beforeResetZoom',
            $this->_buildJsFunction($functionBody, ['chartContext', 'opts'])
        );

        return $this;
    }

    /**
     * Fires when user zooms in/out the chart using either the selection zooming tool or zoom in/out buttons.
     * The 2nd argument includes information of the new xaxis/yaxis generated after zooming.
     *
     * @note Available params: chartContext, {xaxis, yaxis}
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsZoomed(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.zoomed',
            $this->_buildJsFunction($functionBody, ['chartContext', '{xaxis, yaxis}'])
        );

        return $this;
    }

    /**
     * Fires when user scrolls using the pan tool.
     * The 2nd argument includes information of the new xaxis generated after scrolling.
     *
     * @note Available params: chartContext, {xaxis}
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsScrolled(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.scrolled',
            $this->_buildJsFunction($functionBody, ['chartContext', '{xaxis}'])
        );

        return $this;
    }

    /**
     * Fires when user drags the brush in a brush chart.
     * The 2nd argument includes information of the new axes generated after scrolling the brush.
     *
     * @note Available params: chartContext, {xaxis, yaxis}
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartEventsTrait
     */
    public function setChartEventsBrushScrolled(string $functionBody): self
    {
        $this->setConfig(
            'chart.events.brushScrolled',
            $this->_buildJsFunction($functionBody, ['chartContext', '{xaxis, yaxis}'])
        );

        return $this;
    }
}