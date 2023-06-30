<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;

use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait XaxisTrait
{

    /**
     * @var string[]
     */
    protected array $_xaxisCategories = [];

    /**
     * Available Options:
     *  - category
     *  - datetime
     *  - numeric
     *
     * @param string $type
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisType(string $type): self
    {
        $valid = ['category', 'datetime', 'numeric'];
        if (!in_array($type, $valid)) {
            throw new ApexChartWrongOptionException('xaxis.type', $type, $valid);
        }
        $this->setConfig('xaxis.type', $type);

        return $this;
    }

    /**
     * @param array $categories
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCategories(array $categories): self
    {
        $this->_xaxisCategories[] = $categories;

        return $this;
    }

    /**
     * @param string $name
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function addXaxisCategory(string $name): self
    {
        $this->_xaxisCategories[] = $name;

        return $this;
    }

    /**
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function resetXaxisCategories(): self
    {
        $this->_xaxisCategories = [];

        return $this;
    }

    /**
     * @return void
     */
    private function _setXaxisCategories(): void
    {
        if (!empty($this->_xaxisCategories)) {
            $this->setConfig('xaxis.categories', $this->_xaxisCategories);
        }
    }

    /**
     * Number of Tick Intervals to show.
     *
     * @note tickAmount doesn’t have any effect when xaxis.type = datetime
     * @note If you have a numeric xaxis xaxis.type = 'numeric', you can specify tickAmount: 'dataPoints' which would make the number of ticks equal to the number of dataPoints in the chart.
     * @param int|string $tickAmount
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTickAmount(int|string $tickAmount): self
    {
        $this->setConfig('xaxis.tickAmount', $tickAmount);

        return $this;
    }

    /**
     * Whether to draw the ticks in between the data-points or on the data-points.
     * Available options:
     *  - between
     *  - on
     *
     * @note tickPlacement only works for xaxis.type: category charts and not for datetime charts.
     * @param string $tickPlacement
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTickPlacement(string $tickPlacement): self
    {
        $valid = ['between', 'on'];
        if (!in_array($tickPlacement, $valid)) {
            throw new ApexChartWrongOptionException('xaxis.tickPlacement', $tickPlacement, $valid);
        }
        $this->setConfig('xaxis.tickPlacement', $tickPlacement);

        return $this;
    }

    /**
     * The lowest number to be set for the x-axis. The graph drawing beyond this number will be clipped off
     *
     * @param int $min
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisMin(int $min): self
    {
        $this->setConfig('xaxis.min', $min);

        return $this;
    }

    /**
     * The highest number to be set for the x-axis. The graph drawing beyond this number will be clipped off
     *
     * @param int $max
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisMax(int $max): self
    {
        $this->setConfig('xaxis.max', $max);

        return $this;
    }

    /**
     * range takes the max value of x-axis, subtracts the provided range value and gets the min value based on that.
     * So, technically it helps to keep the same range when min and max values gets updated dynamically
     *
     * @param int $range
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisRange(int $range): self
    {
        $this->setConfig('xaxis.range', $range);

        return $this;
    }

    /**
     * Setting this options takes the y-axis out of the plotting area. Much behaves like position: absolute property of CSS
     *
     * @param bool $floating
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisFloating(bool $floating): self
    {
        $this->setConfig('xaxis.floating', $floating);

        return $this;
    }

    /**
     * The number of fractions to display when there are floating values on the x-axis numbers.
     *
     * @note Works only in numeric type.
     * @param int $decimalsInFloat
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisDecimalsInFloat(int $decimalsInFloat): self
    {
        $this->setConfig('xaxis.decimalsInFloat', $decimalsInFloat);

        return $this;
    }

    /**
     * Allows you to overwrite all the labels of the x-axis with these labels. Accepts an array of string values.
     *
     * @param array $overwriteCategories
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisOverwriteCategories(array $overwriteCategories): self
    {
        $this->setConfig('xaxis.overwriteCategories', $overwriteCategories);

        return $this;
    }

    /**
     * Setting this option allows you to change the x-axis position
     * Available options:
     *  - bottom
     *  - top
     *
     * @param string $position
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisPosition(string $position): self
    {
        $valid = ['bottom', 'top'];
        if (!in_array($position, $valid)) {
            throw new ApexChartWrongOptionException('xaxis.position', $position, $valid);
        }
        $this->setConfig('xaxis.position', $position);

        return $this;
    }

    /**
     * Show labels on x-axis
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsShow(bool $show): self
    {
        $this->setConfig('xaxis.labels.show', $show);

        return $this;
    }

    /**
     * Rotate angle for the x-axis labels
     *
     * @param int $rotate
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsRotate(int $rotate): self
    {
        $this->setConfig('xaxis.labels.rotate', $rotate);

        return $this;
    }

    /**
     * Whether to rotate the labels always or to rotate only when the texts don’t fit the available width
     *
     * @param bool $rotateAlways
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsRotateAlways(bool $rotateAlways): self
    {
        $this->setConfig('xaxis.labels.rotateAlways', $rotateAlways);

        return $this;
    }

    /**
     * When labels are too close and start to overlap on one another, this option prevents overlapping of the labels.
     *
     * @param bool $hideOverlappingLabels
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsHideOverlappingLabels(bool $hideOverlappingLabels): self
    {
        $this->setConfig('xaxis.labels.hideOverlappingLabels', $hideOverlappingLabels);

        return $this;
    }

    /**
     * By default, duplicate labels are not printed to prevent congested values in a datetime series.
     * If you intentionally want to display the same values in x-axis labels, turn on this option
     *
     * @param bool $showDuplicates
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsShowDuplicates(bool $showDuplicates): self
    {
        $this->setConfig('xaxis.labels.showDuplicates', $showDuplicates);

        return $this;
    }

    /**
     * Append ... to the text when it can’t fit the available space and rotate is turned off
     *
     * @param bool $trim
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsTrim(bool $trim): self
    {
        $this->setConfig('xaxis.labels.trim', $trim);

        return $this;
    }

    /**
     * Minimum height for the labels
     *
     * @param int $minHeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsMinHeight(int $minHeight): self
    {
        $this->setConfig('xaxis.labels.minHeight', $minHeight);

        return $this;
    }

    /**
     * Maximum height for the labels when they are rotated.
     *
     * @param int $maxHeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsMaxHeight(int $maxHeight): self
    {
        $this->setConfig('xaxis.labels.maxHeight', $maxHeight);

        return $this;
    }

    /**
     * ForeColor for the x-axis label. Accepts an array for distributed charts or accepts a single color string.
     *
     * @param array|string $colors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsStyleColors(array|string $colors): self
    {
        if (is_array($colors)) {
            foreach ($colors as $color) {
                Colors::validateColorOrFail($color);
            }
        } else {
            Colors::validateColorOrFail($colors);
        }
        $this->setConfig('xaxis.labels.style.colors', $colors);

        return $this;
    }

    /**
     * FontSize for the x-axis label
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsStyleFontSize(string $fontSize): self
    {
        $this->setConfig('xaxis.labels.style.fontSize', $fontSize);

        return $this;
    }

    /**
     * FontFamily for the x-axis label
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsStyleFontFamily(string $fontFamily): self
    {
        $this->setConfig('xaxis.labels.style.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * Font-weight for the x-axis label
     *
     * @param string|int $fontWeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsStyleFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('xaxis.labels.style.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * Font-weight for the x-axis label
     *
     * @param string $cssClass
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsStyleCssClass(string $cssClass): self
    {
        $this->setConfig('xaxis.labels.style.cssClass', $cssClass);

        return $this;
    }

    /**
     * Sets the left offset for label
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsOffsetX(int $offsetX): self
    {
        $this->setConfig('xaxis.labels.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset for label
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsOffsetY(int $offsetY): self
    {
        $this->setConfig('xaxis.labels.offsetY', $offsetY);

        return $this;
    }

    /**
     * Formats the datetime value based on the format specifier.
     * See the list of available format specifiers bellow
     *
     * @link https://apexcharts.com/docs/datetime/
     * @param string $format
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsFormat(string $format): self
    {
        $this->setConfig('xaxis.labels.format', $format);

        return $this;
    }

    /**
     * Overrides everything and applies a custom function for the xaxis value.
     * The function accepts 3 arguments.
     * The first one is the default formatted value and the second one as the raw timestamp which you can pass to any datetime handling function to suit your needs.
     * The 3rd argument is present in date-time xaxis which includes a dateFormatter.
     *
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsFormatter(string $functionBody): self
    {
        $this->setConfig('xaxis.labels.formatter', $this->_buildJsFunction($functionBody, ['value', 'timestamp', 'opts']));

        return $this;
    }

    /**
     * When turned on, local DateTime is converted into UTC. Turn it off if you supply date with timezone info and want to preserve it.
     *
     * @param bool $datetimeUTC
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsDatetimeUTC(bool $datetimeUTC): self
    {
        $this->setConfig('xaxis.labels.datetimeUTC', $datetimeUTC);

        return $this;
    }

    /**
     * For the default timescale that is generated automatically based on the datetime difference, the below specifiers are used by default.
     * Format specifier for the year.
     *
     * @param string $year
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsDatetimeFormatterYear(string $year): self
    {
        $this->setConfig('xaxis.labels.datetimeFormatter.year', $year);

        return $this;
    }

    /**
     * For the default timescale that is generated automatically based on the datetime difference, the below specifiers are used by default.
     * Format specifier for the month.
     *
     * @param string $month
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsDatetimeFormatterMonth(string $month): self
    {
        $this->setConfig('xaxis.labels.datetimeFormatter.month', $month);

        return $this;
    }

    /**
     * For the default timescale that is generated automatically based on the datetime difference, the below specifiers are used by default.
     * Format specifier for the day of month.
     *
     * @param string $day
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsDatetimeFormatterDay(string $day): self
    {
        $this->setConfig('xaxis.labels.datetimeFormatter.day', $day);

        return $this;
    }

    /**
     * For the default timescale that is generated automatically based on the datetime difference, the below specifiers are used by default.
     * Format specifier for the hour of day.
     *
     * @param string $hour
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisLabelsDatetimeFormatterHour(string $hour): self
    {
        $this->setConfig('xaxis.labels.datetimeFormatter.hour', $hour);

        return $this;
    }

    /**
     * Draw a horizontal border on the x-axis
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisAxisBorderShow(bool $show): self
    {
        $this->setConfig('xaxis.axisBorder.show', $show);

        return $this;
    }

    /**
     * Color of the horizontal axis border
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisAxisBorderColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('xaxis.axisBorder.color', $color);

        return $this;
    }

    /**
     * Sets the border height of the xaxis line
     *
     * @param string|int $height
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisAxisBorderHeight(string|int $height): self
    {
        $this->setConfig('xaxis.axisBorder.height', $height);

        return $this;
    }

    /**
     * Sets the width of the xaxis line
     *
     * @param string|int $width
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisAxisBorderWidth(string|int $width): self
    {
        $this->setConfig('xaxis.axisBorder.width', $width);

        return $this;
    }

    /**
     * Sets the left offset of the axis border
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisAxisBorderOffsetX(int $offsetX): self
    {
        $this->setConfig('xaxis.axisBorder.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset of the axis border
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisAxisBorderOffsetY(int $offsetY): self
    {
        $this->setConfig('xaxis.axisBorder.offsetY', $offsetY);

        return $this;
    }

    /**
     * Draw ticks on the x-axis to specify intervals
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisAxisTicksShow(bool $show): self
    {
        $this->setConfig('xaxis.axisTicks.show', $show);

        return $this;
    }

    /**
     * Available Options:
     *  - solid
     *  - dotted
     *
     * @param string $borderType
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisAxisTicksBorderType(string $borderType): self
    {
        $valid = ['solid', 'dotted'];
        if (!in_array($borderType, $valid)) {
            throw new ApexChartWrongOptionException('xaxis.axisTicks.borderType', $borderType, $valid);
        }
        $this->setConfig('xaxis.axisTicks.borderType', $borderType);

        return $this;
    }

    /**
     * Color of the ticks
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisAxisTicksColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('xaxis.axisTicks.color', $color);

        return $this;
    }

    /**
     * Height of the ticks
     *
     * @param string|int $height
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisAxisTicksHeight(string|int $height): self
    {
        $this->setConfig('xaxis.axisTicks.height', $height);

        return $this;
    }

    /**
     * Sets the left offset of the ticks
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisAxisTicksOffsetX(int $offsetX): self
    {
        $this->setConfig('xaxis.axisTicks.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset of the ticks
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisAxisTicksOffsetY(int $offsetY): self
    {
        $this->setConfig('xaxis.axisTicks.offsetY', $offsetY);

        return $this;
    }

    /**
     * Give the x-axis a title which will be displayed below the axis labels by default.
     *
     * @param string $text
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTitleText(string $text): self
    {
        $this->setConfig('xaxis.title.text', $text);

        return $this;
    }

    /**
     * Sets the left offset for xaxis title.
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTitleOffsetX(int $offsetX): self
    {
        $this->setConfig('xaxis.title.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset for xaxis title.
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTitleOffsetY(int $offsetY): self
    {
        $this->setConfig('xaxis.title.offsetY', $offsetY);

        return $this;
    }

    /**
     * ForeColor of the x-axis title
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTitleStyleColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('xaxis.title.style.color', $color);

        return $this;
    }

    /**
     * FontSize for the x-axis title
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTitleStyleFontSize(string $fontSize): self
    {
        $this->setConfig('xaxis.title.style.fontSize', $fontSize);

        return $this;
    }

    /**
     * FontFamily for the x-axis title
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTitleStyleFontFamily(string $fontFamily): self
    {
        $this->setConfig('xaxis.title.style.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * Font-weight for the x-axis title
     *
     * @param string|int $fontWeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTitleStyleFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('xaxis.title.style.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * A custom Css Class to give to the x-axis title
     *
     * @param string $cssClass
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTitleStyleCssClass(string $cssClass): self
    {
        $this->setConfig('xaxis.title.style.cssClass', $cssClass);

        return $this;
    }

    /**
     * Show crosshairs on x-axis when user moves the mouse over chart area
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsShow(bool $show): self
    {
        $this->setConfig('xaxis.crosshairs.show', $show);

        return $this;
    }

    /**
     * Possible Options:
     *  - Any number
     *  - tickWidth Takes the tick intervals on x-axis and creates a crosshair of that width
     *  - barWidth Takes the barWidth and creates a crosshair of that width – only applicable to vertical bar charts
     *
     * @param int|string $width
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsWidth(int|string $width): self
    {
        if (is_string($width)) {
            $valid = ['tickWidth', 'barWidth'];
            if (!in_array($width, $valid)) {
                throw new ApexChartWrongOptionException('xaxis.crosshairs.width', $width, $valid);
            }
        }
        $this->setConfig('xaxis.crosshairs.width', $width);

        return $this;
    }

    /**
     * Possible Options:
     *  - back
     *  - front
     *
     * @param string $position
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsPosition(string $position): self
    {
        $valid = ['tickWidth', 'barWidth'];
        if (!in_array($position, $valid)) {
            throw new ApexChartWrongOptionException('xaxis.crosshairs.position', $position, $valid);
        }
        $this->setConfig('xaxis.crosshairs.position', $position);

        return $this;
    }

    /**
     * Opacity of the crosshairs
     *
     * @param float $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsOpacity(float $opacity): self
    {
        $this->setConfig('xaxis.crosshairs.opacity', $opacity);

        return $this;
    }

    /**
     * Border Color of crosshairs
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsStrokeColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('xaxis.crosshairs.stroke.color', $color);

        return $this;
    }

    /**
     * Border Width of crosshairs
     *
     * @param int $width
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsStrokeWidth(int $width): self
    {
        $this->setConfig('xaxis.crosshairs.stroke.width', $width);

        return $this;
    }

    /**
     * Creates dashes in borders of crosshairs. A higher number creates more space between dashes in the border.
     *
     * @param int $dashArray
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsStrokeDashArray(int $dashArray): self
    {
        $this->setConfig('xaxis.crosshairs.stroke.dashArray', $dashArray);

        return $this;
    }

    /**
     * Possible Options:
     *  - solid
     *  - gradient
     *
     * @param string $type
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsFillType(string $type): self
    {
        $valid = ['solid', 'gradient'];
        if (!in_array($type, $valid)) {
            throw new ApexChartWrongOptionException('xaxis.crosshairs.fill.type', $type, $valid);
        }
        $this->setConfig('xaxis.crosshairs.fill.type', $type);

        return $this;
    }

    /**
     * Fill color of crosshairs
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsFillColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('xaxis.crosshairs.fill.color', $color);

        return $this;
    }

    /**
     * Crosshairs Gradient Color from
     *
     * @param string $colorFrom
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsFillGradientColorFrom(string $colorFrom): self
    {
        Colors::validateColorOrFail($colorFrom);
        $this->setConfig('xaxis.crosshairs.fill.gradient.colorFrom', $colorFrom);

        return $this;
    }

    /**
     * Crosshairs Gradient Color to
     *
     * @param string $colorTo
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsFillGradientColorTo(string $colorTo): self
    {
        Colors::validateColorOrFail($colorTo);
        $this->setConfig('xaxis.crosshairs.fill.gradient.colorTo', $colorTo);

        return $this;
    }

    /**
     * Stops defines the ramp of colors to use on a gradient
     *
     * @param array $stops
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsFillGradientStops(array $stops): self
    {
        foreach ($stops as $stop) {
            Colors::validateColorOrFail($stop);
        }
        $this->setConfig('xaxis.crosshairs.fill.gradient.stops', $stops);

        return $this;
    }

    /**
     * Crosshairs fill opacity from
     *
     * @param float $opacityFrom
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsFillGradientOpacityFrom(float $opacityFrom): self
    {
        $this->setConfig('xaxis.crosshairs.fill.gradient.opacityFrom', $opacityFrom);

        return $this;
    }

    /**
     * Crosshairs fill opacity to
     *
     * @param float $opacityTo
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsFillGradientOpacityTo(float $opacityTo): self
    {
        $this->setConfig('xaxis.crosshairs.fill.gradient.opacityTo', $opacityTo);

        return $this;
    }

    /**
     * Enable a dropshadow for crosshairs
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsDropShadowEnabled(bool $enabled): self
    {
        $this->setConfig('xaxis.crosshairs.dropShadow.enabled', $enabled);

        return $this;
    }

    /**
     * Set top offset for shadow
     *
     * @param int $top
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsDropShadowTop(int $top): self
    {
        $this->setConfig('xaxis.crosshairs.dropShadow.top', $top);

        return $this;
    }

    /**
     * Set left offset for shadow
     *
     * @param int $left
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsDropShadowLeft(int $left): self
    {
        $this->setConfig('xaxis.crosshairs.dropShadow.left', $left);

        return $this;
    }

    /**
     * Set blur distance for shadow
     *
     * @param float $blur
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsDropShadowBlur(float $blur): self
    {
        $this->setConfig('xaxis.crosshairs.dropShadow.blur', $blur);

        return $this;
    }

    /**
     * Set the opacity of shadow.
     *
     * @param float $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisCrosshairsDropShadowOpacity(float $opacity): self
    {
        $this->setConfig('xaxis.crosshairs.dropShadow.opacity', $opacity);

        return $this;
    }

    /**
     * Show tooltip on x-axis or not
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTooltipEnabled(bool $enabled): self
    {
        $this->setConfig('xaxis.tooltip.enabled', $enabled);

        return $this;
    }

    /**
     * A custom formatter function for the x-axis tooltip label. If undefined, the xaxis tooltip uses the default “X” value used in general tooltip.
     *
     * @note available parameters 'val' and 'opts'
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTooltipFormatter(string $functionBody): self
    {
        $this->setConfig('xaxis.tooltip.formatter', $this->_buildJsFunction($functionBody, ['val', 'opts']));

        return $this;
    }

    /**
     * Sets the top offset for x-axis tooltip
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTooltipOffsetY(int $offsetY): self
    {
        $this->setConfig('xaxis.tooltip.offsetY', $offsetY);

        return $this;
    }

    /**
     * FontSize for the x-axis tooltip text
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTooltipStyleFontSize(string $fontSize): self
    {
        $this->setConfig('xaxis.tooltip.style.fontSize', $fontSize);

        return $this;
    }

    /**
     * FontFamily for the x-axis tooltip text
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\XaxisTrait
     */
    public function setXaxisTooltipStyleFontFamily(string $fontFamily): self
    {
        $this->setConfig('xaxis.tooltip.style.fontFamily', $fontFamily);

        return $this;
    }

}