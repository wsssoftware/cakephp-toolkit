<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;

use Toolkit\Exception\ApexChartWrongOptionException;

trait TooltipTrait
{

    /**
     * Show tooltip when user hovers over chart area.
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipEnabled(bool $enabled): self
    {
        $this->setConfig('tooltip.enabled', $enabled);

        return $this;
    }

    /**
     * Show tooltip only on certain series in a multi-series chart. Provide indices of those series which you would like to be shown.
     *
     * @param array $enabledOnSeries
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipEnabledOnSeries(array $enabledOnSeries): self
    {
        $this->setConfig('tooltip.enabledOnSeries', $enabledOnSeries);

        return $this;
    }

    /**
     * When having multiple series, show a shared tooltip.
     * If you have a DateTime x-axis and multiple series chart ‐ make sure all
     * your series has the same “x” values for a shared tooltip to work smoothly.
     *
     * @param bool $shared
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipShared(bool $shared): self
    {
        $this->setConfig('tooltip.shared', $shared);

        return $this;
    }

    /**
     * Follow user’s cursor position instead of putting tooltip on actual data points.
     *
     * @param bool $followCursor
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipFollowCursor(bool $followCursor): self
    {
        $this->setConfig('tooltip.followCursor', $followCursor);

        return $this;
    }

    /**
     * Show tooltip only when user hovers exactly over datapoint.
     *
     * @param bool $intersect
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipIntersect(bool $intersect): self
    {
        $this->setConfig('tooltip.intersect', $intersect);

        return $this;
    }

    /**
     * In multiple series, when having shared tooltip, inverse the order of series (for better comparison in stacked charts).
     *
     * @param bool $inverseOrder
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipInverseOrder(bool $inverseOrder): self
    {
        $this->setConfig('tooltip.inverseOrder', $inverseOrder);

        return $this;
    }

    /**
     * Draw a custom html tooltip instead of the default one based on the values provided in the function arguments.
     *
     * @note available parameters {series, seriesIndex, dataPointIndex, w}
     * @note In a multi-seris/combo chart, you can pass an array of functions to customize tooltip for different chart types. For instance, a combo chart with a candlestick and a line will have different tooltips.
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipCustom(string $functionBody): self
    {
        $this->setConfig('tooltip.custom', $this->_buildJsFunction($functionBody, ['{series, seriesIndex, dataPointIndex, w}']));

        return $this;
    }

    /**
     * When enabled, fill the tooltip background with the corresponding series color
     *
     * @param bool $fillSeriesColor
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipFillSeriesColor(bool $fillSeriesColor): self
    {
        $this->setConfig('tooltip.fillSeriesColor', $fillSeriesColor);

        return $this;
    }

    /**
     * Available Options:
     *  - light
     *  - dark
     *
     * If you further want to customize different background and forecolor of the tooltip, you should do it in CSS
     *
     * @param string $theme
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipTheme(string $theme): self
    {
        $valid = ['light', 'dark'];
        if (!in_array($theme, $valid)) {
            throw new ApexChartWrongOptionException('tooltip.theme', $theme, $valid);
        }
        $this->setConfig('tooltip.theme', $theme);

        return $this;
    }

    /**
     * Font-family to apply on tooltip texts
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipStyleFontFamily(string $fontFamily): self
    {
        $this->setConfig('tooltip.style.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * Font-size to apply on tooltip texts
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipStyleFontSize(string $fontSize): self
    {
        $this->setConfig('tooltip.style.fontSize', $fontSize);

        return $this;
    }

    /**
     * When user hovers over a datapoint of a particular series, other series will be grayed out making the current series highlight.
     *
     * @param bool $highlightDataSeries
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipOnDatasetHoverHighlightDataSeries(bool $highlightDataSeries): self
    {
        $this->setConfig('tooltip.onDatasetHover.highlightDataSeries', $highlightDataSeries);

        return $this;
    }

    /**
     * Whether to show the tooltip title (x-axis values) on tooltip or not
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipXShow(bool $show): self
    {
        $this->setConfig('tooltip.x.show', $show);

        return $this;
    }

    /**
     * The format of the x-axis value to show on the tooltip. To view how to format datetime Strings, view the Datetime Formatter guide.
     *
     * @param string $format
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipXFormat(string $format): self
    {
        $this->setConfig('tooltip.x.format', $format);

        return $this;
    }

    /**
     * A custom formatter function which you can override and display according to your needs (a use case can be a date formatted using complex moment.js functions)
     *
     * @note available parameters 'value'
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipXFormatter(string $functionBody): self
    {
        $this->setConfig('tooltip.x.formatter', $this->_buildJsFunction($functionBody, ['value']));

        return $this;
    }

    /**
     * To format the Y-axis values of tooltip, you can define a custom formatter function. By default, these values will be formatted according yaxis.labels.formatter function which will be overrided by this function if you define it.
     *
     * @note available parameters 'value', '{series, seriesIndex, dataPointIndex, w}
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipYFormatter(string $functionBody): self
    {
        $this->setConfig('tooltip.y.formatter', $this->_buildJsFunction($functionBody, ['value', '{series, seriesIndex, dataPointIndex, w}']));

        return $this;
    }

    /**
     * The series name which appears besides values can be formatted using this function.
     *
     * @note available parameters 'seriesName'
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipYTitleFormatter(string $functionBody): self
    {
        $this->setConfig('tooltip.y.title.formatter', $this->_buildJsFunction($functionBody, ['seriesName']));

        return $this;
    }

    /**
     * To format the z values of a Bubble series, you can use this function.
     *
     * @note available parameters 'value', '{series, seriesIndex, dataPointIndex, w}
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipZFormatter(string $functionBody): self
    {
        $this->setConfig('tooltip.z.formatter', $this->_buildJsFunction($functionBody, ['value', '{series, seriesIndex, dataPointIndex, w}']));

        return $this;
    }

    /**
     * A custom text for the z values of Bubble Series.
     *
     * @note available parameters 'seriesName'
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipZTitleFormatter(string $functionBody): self
    {
        $this->setConfig('tooltip.z.title.formatter', $this->_buildJsFunction($functionBody, ['seriesName']));

        return $this;
    }

    /**
     * Whether to show the color coded marker shape in front of Series Name which helps to identify series in multiple datasets.
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipMarkerShow(bool $show): self
    {
        $this->setConfig('tooltip.marker.show', $show);

        return $this;
    }

    /**
     * The css property of each tooltip item container.
     *
     * @param string $display
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipItemsDisplay(string $display): self
    {
        $this->setConfig('tooltip.items.display', $display);

        return $this;
    }

    /**
     * Set the tooltip to a fixed position
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipFixedEnabled(bool $enabled): self
    {
        $this->setConfig('tooltip.fixed.enabled', $enabled);

        return $this;
    }

    /**
     * When having a fixed tooltip, select a predefined position.
     * Available Options:
     *  - topLeft
     *  - topRight
     *  - bottomLeft
     *  - bottomRight
     *
     * @param string $position
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipFixedPosition(string $position): self
    {
        $valid = ['topLeft', 'topRight', 'bottomLeft', 'bottomRight'];
        if (!in_array($position, $valid)) {
            throw new ApexChartWrongOptionException('tooltip.fixed.position', $position, $valid);
        }
        $this->setConfig('tooltip.fixed.position', $position);

        return $this;
    }

    /**
     * Sets the left offset for the tooltip container in fixed position
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipFixedOffsetX(int $offsetX): self
    {
        $this->setConfig('tooltip.fixed.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset for the tooltip container in fixed position
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TooltipTrait
     */
    public function setTooltipFixedOffsetY(int $offsetY): self
    {
        $this->setConfig('tooltip.fixed.offsetY', $offsetY);

        return $this;
    }

}