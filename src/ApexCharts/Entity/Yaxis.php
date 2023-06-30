<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Entity;


use Cake\Core\Configure;
use Cake\Core\InstanceConfigTrait;
use Toolkit\ApexCharts\ApexChart;
use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

class Yaxis
{
    use InstanceConfigTrait;

    /**
     * Default config for annotation.
     *
     * @var array
     */
    protected array $_defaultConfig = [];

    /**
     * @var \Toolkit\ApexCharts\ApexChart
     */
    protected ApexChart $_apexChart;

    /**
     * Yaxis constructor.
     *
     * @param \Toolkit\ApexCharts\ApexChart $apexChart
     */
    public function __construct(ApexChart $apexChart)
    {
        $this->_apexChart = $apexChart;
    }

    /**
     * Whether to display the y-axis or not.
     *
     * @param bool $show
     * @return self
     */
    public function setShow(bool $show): self
    {
        $this->setConfig('show', $show);

        return $this;
    }

    /**
     * Whether to hide y-axis when user toggles series through legend.
     *
     * @param bool $showAlways
     * @return self
     */
    public function setShowAlways(bool $showAlways): self
    {
        $this->setConfig('showAlways', $showAlways);

        return $this;
    }

    /**
     * When turned off, it will hide the y-axis completely for a series which has no data or a series with all null values.
     *
     * @param bool $showForNullSeries
     * @return self
     */
    public function setShowForNullSeries(bool $showForNullSeries): self
    {
        $this->setConfig('showForNullSeries', $showForNullSeries);

        return $this;
    }

    /**
     * In a multiple y-axis chart, you can target the scale of a y-axis to a particular series by referencing through the seriesName.
     * The series item which have the same name property will be used to calculate the scale of the y-axis.
     *
     * @param string $seriesName
     * @return self
     */
    public function setSeriesName(string $seriesName): self
    {
        $this->setConfig('seriesName', $seriesName);

        return $this;
    }

    /**
     * When enabled, will draw the yaxis on the right side of the chart
     *
     * @param bool $opposite
     * @return self
     */
    public function setOpposite(bool $opposite): self
    {
        $this->setConfig('opposite', $opposite);

        return $this;
    }

    /**
     * Flip the chart upside down making it inversed and draw y-axis from bigger to smaller numbers.
     *
     * @param bool $reversed
     * @return self
     */
    public function setReversed(bool $reversed): self
    {
        $this->setConfig('reversed', $reversed);

        return $this;
    }

    /**
     * A non-linear scale when there is a large range of values.
     *
     * @param bool $logarithmic
     * @return self
     */
    public function setLogarithmic(bool $logarithmic): self
    {
        $this->setConfig('logarithmic', $logarithmic);

        return $this;
    }

    /**
     * Number of Tick Intervals to show
     *
     * @param int $tickAmount
     * @return self
     */
    public function setTickAmount(int $tickAmount): self
    {
        $this->setConfig('tickAmount', $tickAmount);

        return $this;
    }

    /**
     * Lowest number to be set for the y-axis. The graph drawing beyond this number will be clipped off
     * You can also pass a function here which should return a number.
     * The function accepts an argument which by default is the smallest value in the y-axis. function(min) { return min }
     *
     * @note available parameters 'min'
     * @param float|int|string $min
     * @return self
     */
    public function setMin(float|int|string $min): self
    {
        if (is_string($min)) {
            $this->setConfig('min', $this->_apexChart->_buildJsFunction($min, ['min']));
        } else {
            $this->setConfig('min', $min);
        }

        return $this;
    }

    /**
     * Highest number to be set for the y-axis. The graph drawing beyond this number will be clipped off.
     * You can also pass a function here which should return a number.
     * The function accepts an argument which by default is the smallest value in the y-axis. function(max) { return max }
     *
     * @note available parameters 'max'
     * @param float|int|string $max
     * @return self
     */
    public function setMax(float|int|string $max): self
    {
        if (is_string($max)) {
            $this->setConfig('max', $this->_apexChart->_buildJsFunction($max, ['max']));
        } else {
            $this->setConfig('max', $max);
        }

        return $this;
    }

    /**
     * range takes the max value of y-axis, subtracts the provided range value and gets the min value based on that. So, technically it helps to keep the same range when min and max values gets updated dynamically
     *
     * @note available parameters 'max'
     * @param int $range
     * @return self
     */
    public function setRange(int $range): self
    {
        $this->setConfig('range', $range);

        return $this;
    }

    /**
     * If set to true, the y-axis scales are forced to generate nice looking rounded numbers even when min/max are provided.
     * Turn this off if you manually set min/max and want it to be unchanged.
     *
     * @param bool $forceNiceScale
     * @return self
     */
    public function setForceNiceScale(bool $forceNiceScale): self
    {
        $this->setConfig('forceNiceScale', $forceNiceScale);

        return $this;
    }

    /**
     * Setting this options takes the y-axis out of the plotting area. Much behaves like position: absolute property of CSS
     *
     * @param bool $floating
     * @return self
     */
    public function setFloating(bool $floating): self
    {
        $this->setConfig('floating', $floating);

        return $this;
    }

    /**
     * Setting this option allows you to change the y-axis position
     * Available options:
     *  - bottom
     *  - top
     *
     * @param string $position
     * @return self
     */
    public function setPosition(string $position): self
    {
        $valid = ['bottom', 'top'];
        if (!in_array($position, $valid)) {
            throw new ApexChartWrongOptionException('yaxis.position', $position, $valid);
        }
        $this->setConfig('position', $position);

        return $this;
    }

    /**
     * The number of fractions to display when there are floating values in y-axis.
     *
     * @note If you have defined a custom formatter function in yaxis.labels.formatter, this won’t have any effect.
     * @param int $decimalsInFloat
     * @return self
     */
    public function setDecimalsInFloat(int $decimalsInFloat): self
    {
        $this->setConfig('decimalsInFloat', $decimalsInFloat);

        return $this;
    }

    /**
     * Show labels on y-axis
     *
     * @param bool $show
     * @return self
     */
    public function setLabelsShow(bool $show): self
    {
        $this->setConfig('labels.show', $show);

        return $this;
    }

    /**
     * Available Options:
     *  - left
     *  - center
     *  - right
     *
     * @param string $align
     * @return self
     */
    public function setLabelsAlign(string $align): self
    {
        $valid = ['left', 'center', 'right'];
        if (!in_array($align, $valid)) {
            throw new ApexChartWrongOptionException('yaxis.labels.align', $align, $valid);
        }
        $this->setConfig('labels.align', $align);

        return $this;
    }

    /**
     * Minimum width for the y-axis labels
     *
     * @param int $minWidth
     * @return self
     */
    public function setLabelsMinWidth(int $minWidth): self
    {
        $this->setConfig('labels.minWidth', $minWidth);

        return $this;
    }

    /**
     * Maximum width for the y-axis labels
     *
     * @param int $maxWidth
     * @return self
     */
    public function setLabelsMaxWidth(int $maxWidth): self
    {
        $this->setConfig('labels.maxWidth', $maxWidth);

        return $this;
    }

    /**
     * ForeColor for the y-axis label
     *
     * @param array|string $colors
     * @return self
     */
    public function setLabelsStyleColors(array|string $colors): self
    {
        if (is_array($colors)) {
            foreach ($colors as $color) {
                Colors::validateColorOrFail($color);
            }
        } else {
            Colors::validateColorOrFail($colors);
        }
        $this->setConfig('labels.style.colors', $colors);

        return $this;
    }

    /**
     * FontSize for the y-axis label
     *
     * @param string $fontSize
     * @return self
     */
    public function setLabelsStyleFontSize(string $fontSize): self
    {
        $this->setConfig('labels.style.fontSize', $fontSize);

        return $this;
    }

    /**
     * Font-family for the y-axis label.Font-family for the y-axis label.
     *
     * @param string $fontFamily
     * @return self
     */
    public function setLabelsStyleFontFamily(string $fontFamily): self
    {
        $this->setConfig('labels.style.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * Font-weight for the y-axis label.
     *
     * @param string|int $fontWeight
     * @return self
     */
    public function setLabelsStyleFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('labels.style.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * A custom Css Class to give to the label elements
     *
     * @param string $cssClass
     * @return self
     */
    public function setLabelsStyleCssClass(string $cssClass): self
    {
        $this->setConfig('labels.style.cssClass', $cssClass);

        return $this;
    }

    /**
     * Sets the left offset for label
     *
     * @param int $offsetX
     * @return self
     */
    public function setLabelsOffsetX(int $offsetX): self
    {
        $this->setConfig('labels.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset for label
     *
     * @param int $offsetY
     * @return self
     */
    public function setLabelsOffsetY(int $offsetY): self
    {
        $this->setConfig('labels.offsetY', $offsetY);

        return $this;
    }

    /**
     * Rotate y-axis text label to a specific angle from it’s center
     *
     * @param int $rotate
     * @return self
     */
    public function setLabelsRotate(int $rotate): self
    {
        $this->setConfig('labels.rotate', $rotate);

        return $this;
    }

    /**
     * Applies a custom function for the yaxis value.
     *
     * @note available parameters 'val' and 'index'
     * @note In horizontal bar charts, the second parameters also contains additional data like dataPointIndex & seriesIndex.
     * @param string $functionBody
     * @return self
     */
    public function setLabelsFormatter(string $functionBody): self
    {
        $this->setConfig('labels.formatter', $this->_apexChart->_buildJsFunction($functionBody, ['val', 'index']));

        return $this;
    }

    /**
     * Draw a vertical border on the y-axis
     *
     * @param bool $show
     * @return self
     */
    public function setAxisBorderShow(bool $show): self
    {
        $this->setConfig('axisBorder.show', $show);

        return $this;
    }

    /**
     * Color of the horizontal axis border
     *
     * @param string $color
     * @return self
     */
    public function setAxisBorderColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('axisBorder.color', $color);

        return $this;
    }

    /**
     * Sets the left offset of the axis border
     *
     * @param int $offsetX
     * @return self
     */
    public function setAxisBorderOffsetX(int $offsetX): self
    {
        $this->setConfig('axisBorder.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset of the axis border
     *
     * @param int $offsetY
     * @return self
     */
    public function setAxisBorderOffsetY(int $offsetY): self
    {
        $this->setConfig('axisBorder.offsetY', $offsetY);

        return $this;
    }

    /**
     * Draw ticks on the y-axis to specify intervals
     *
     * @param bool $show
     * @return self
     */
    public function setAxisTicksShow(bool $show): self
    {
        $this->setConfig('axisTicks.show', $show);

        return $this;
    }

    /**
     * Available Options:
     *  - solid
     *  - dotted
     *
     * @param string $borderType
     * @return self
     */
    public function setAxisTicksBorderType(string $borderType): self
    {
        $valid = ['solid', 'dotted'];
        if (!in_array($borderType, $valid)) {
            throw new ApexChartWrongOptionException('yaxis.axisTicks.color', $borderType, $valid);
        }
        $this->setConfig('axisTicks.color', $borderType);

        return $this;
    }

    /**
     * Color of the ticks
     *
     * @param string $color
     * @return self
     */
    public function setAxisTicksColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('axisTicks.color', $color);

        return $this;
    }

    /**
     * Width of the ticks
     *
     * @param int $width
     * @return self
     */
    public function setAxisTicksWidth(int $width): self
    {
        $this->setConfig('axisTicks.width', $width);

        return $this;
    }

    /**
     * Sets the left offset of the ticks
     *
     * @param int $offsetX
     * @return self
     */
    public function setAxisTicksOffsetX(int $offsetX): self
    {
        $this->setConfig('axisTicks.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset of the ticks
     *
     * @param int $offsetY
     * @return self
     */
    public function setAxisTicksOffsetY(int $offsetY): self
    {
        $this->setConfig('axisTicks.offsetY', $offsetY);

        return $this;
    }

    /**
     * Give the y-axis a title which will be displayed below the axis labels by default.
     *
     * @param string $text
     * @return self
     */
    public function setTitleText(string $text): self
    {
        $this->setConfig('title.text', $text);

        return $this;
    }

    /**
     * Rotate the yaxis title either 90 or -90.
     *
     * @param int $rotate
     * @return self
     */
    public function setTitleRotate(int $rotate): self
    {
        $this->setConfig('title.rotate', $rotate);

        return $this;
    }

    /**
     * Sets the left offset for yaxis title.
     *
     * @param int $offsetX
     * @return self
     */
    public function setTitleOffsetX(int $offsetX): self
    {
        $this->setConfig('title.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset for yaxis title.
     *
     * @param int $offsetY
     * @return self
     */
    public function setTitleOffsetY(int $offsetY): self
    {
        $this->setConfig('title.offsetY', $offsetY);

        return $this;
    }

    /**
     * ForeColor of the y-axis title
     *
     * @param string $color
     * @return self
     */
    public function setTitleStyleColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('title.style.color', $color);

        return $this;
    }

    /**
     * FontSize for the y-axis title
     *
     * @param string $fontSize
     * @return self
     */
    public function setTitleStyleFontSize(string $fontSize): self
    {
        $this->setConfig('title.style.fontSize', $fontSize);

        return $this;
    }

    /**
     * FontFamily for the y-axis title
     *
     * @param string $fontFamily
     * @return self
     */
    public function setTitleStyleFontFamily(string $fontFamily): self
    {
        $this->setConfig('title.style.fontSize', $fontFamily);

        return $this;
    }

    /**
     * Font-weight for the y-axis title
     *
     * @param string|int $fontWeight
     * @return self
     */
    public function setTitleStyleFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('title.style.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * A custom Css Class to give to the y-axis title
     *
     * @param string $cssClass
     * @return self
     */
    public function setTitleStyleCssClass(string $cssClass): self
    {
        $this->setConfig('title.style.cssClass', $cssClass);

        return $this;
    }

    /**
     * Show crosshairs on y-axis when user moves the mouse over chart area.
     *
     * @note Make sure to have yaxis.tooltip.enabled: 'true' to make the crosshair visible.
     * @param bool $show
     * @return self
     */
    public function setCrosshairsShow(bool $show): self
    {
        $this->setConfig('crosshairs.show', $show);

        return $this;
    }

    /**
     * Possible Options:
     *  - back
     *  - front
     *
     * @param string $position
     * @return self
     */
    public function setCrosshairsPosition(string $position): self
    {
        $valid = ['back', 'front'];
        if (!in_array($position, $valid)) {
            throw new ApexChartWrongOptionException('yaxis.crosshairs.position', $position, $valid);
        }
        $this->setConfig('crosshairs.position', $position);

        return $this;
    }

    /**
     * Border Color of crosshairs
     *
     * @param string $color
     * @return self
     */
    public function setCrosshairsStrokeColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('crosshairs.stroke.color', $color);

        return $this;
    }

    /**
     * Border Width of crosshairs
     *
     * @param int $width
     * @return self
     */
    public function setCrosshairsStrokeWidth(int $width): self
    {
        $this->setConfig('crosshairs.stroke.width', $width);

        return $this;
    }

    /**
     * Creates dashes in borders of crosshairs. Higher number creates more space between dashes in the border.
     *
     * @param int $dashArray
     * @return self
     */
    public function setCrosshairsStrokeDashArray(int $dashArray): self
    {
        $this->setConfig('crosshairs.stroke.dashArray', $dashArray);

        return $this;
    }

    /**
     * Show tooltip on y-axis
     *
     * @param bool $enabled
     * @return self
     */
    public function setTooltipEnabled(bool $enabled): self
    {
        $this->setConfig('tooltip.enabled', $enabled);

        return $this;
    }

    /**
     * Sets the top offset for y-axis tooltip
     *
     * @param int $offsetX
     * @return self
     */
    public function setTooltipOffsetX(int $offsetX): self
    {
        $this->setConfig('tooltip.offsetX', $offsetX);

        return $this;
    }



    /**
     * @param string $currency
     * @param int $maximumFractionDigits
     * @param string|null $locale
     * @return self
     */
    public function setCurrencyFormatter(string $currency, int $maximumFractionDigits = 2, string $locale = null): self
    {
        if (empty($locale)) {
            $locale = str_replace('_', '-', Configure::read('App.defaultLocale', 'en_US'));
        }
        $this->setLabelsFormatter("return Toolkit.apexCharts.formatters.currency(val, '$locale', '$currency', $maximumFractionDigits)");

        return $this;
    }

    /**
     * @param int $maximumFractionDigits
     * @param string|null $locale
     * @return self
     */
    public function setPercentageFormatter(int $maximumFractionDigits = 2, string $locale = null): self
    {
        if (empty($locale)) {
            $locale = str_replace('_', '-', Configure::read('App.defaultLocale', 'en_US'));
        }
        $this->setLabelsFormatter("return Toolkit.apexCharts.formatters.percentage(val, '$locale', $maximumFractionDigits)");

        return $this;
    }
}