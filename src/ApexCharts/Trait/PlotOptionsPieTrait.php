<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;

use Toolkit\Utilities\Colors;

trait PlotOptionsPieTrait
{

    /**
     * A custom angle from which the pie/donut slices should start.
     *
     * @param int $startAngle
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieStartAngle(int $startAngle): self
    {
        $this->setConfig('plotOptions.pie.startAngle', $startAngle);

        return $this;
    }

    /**
     * A custom angle to which the pie/donut slices should end.
     *
     * @param int $endAngle
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieEndAngle(int $endAngle): self
    {
        $this->setConfig('plotOptions.pie.endAngle', $endAngle);

        return $this;
    }

    /**
     * When clicked on the pie/donut slice, expand the slice to make it distinguished visually.
     *
     * @param bool $expandOnClick
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieExpandOnClick(bool $expandOnClick): self
    {
        $this->setConfig('plotOptions.pie.expandOnClick', $expandOnClick);

        return $this;
    }

    /**
     * Sets the left offset of the whole pie area
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieOffsetX(int $offsetX): self
    {
        $this->setConfig('plotOptions.pie.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset of the whole pie area
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieOffsetY(int $offsetY): self
    {
        $this->setConfig('plotOptions.pie.offsetY', $offsetY);

        return $this;
    }

    /**
     * Transform the scale of whole pie/donut overriding the default calculations.
     * Try variations like 0.5 and 1.5 to see how it scales based on the default width/height of the pie
     *
     * @param float $customScale
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieCustomScale(float $customScale): self
    {
        $this->setConfig('plotOptions.pie.customScale', $customScale);

        return $this;
    }

    /**
     * Offset by which labels will move outside / inside of the donut area
     *
     * @param int $offset
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDataLabelsOffset(int $offset): self
    {
        $this->setConfig('plotOptions.pie.dataLabels.offset', $offset);

        return $this;
    }

    /**
     * Minimum angle to allow data-labels to show.
     * If the slice angle is less than this number, the label would not show to prevent overlapping issues.
     *
     * @param int $minAngleToShowLabel
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDataLabelsMinAngleToShowLabel(int $minAngleToShowLabel): self
    {
        $this->setConfig('plotOptions.pie.dataLabels.minAngleToShowLabel', $minAngleToShowLabel);

        return $this;
    }

    /**
     * Donut / ring size in percentage relative to the total pie area.
     *
     * @param string $size
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutSize(string $size): self
    {
        $this->setConfig('plotOptions.pie.donut.size', $size);

        return $this;
    }

    /**
     * The background color of the pie
     *
     * @param string $background
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutBackground(string $background): self
    {
        Colors::validateColorOrFail($background);
        $this->setConfig('plotOptions.pie.donut.background', $background);

        return $this;
    }

    /**
     * Whether to display inner labels or not.
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsShow(bool $show): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.show', $show);

        return $this;
    }

    /**
     * Show the name of the respective bar associated with it’s value
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsNameShow(bool $show): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.name.show', $show);

        return $this;
    }

    /**
     * FontSize of the name in donut’s label
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsNameFontSize(string $fontSize): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.name.fontSize', $fontSize);

        return $this;
    }

    /**
     * FontSize of the name in donut’s label
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsNameFontFamily(string $fontFamily): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.name.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * Font-weight of the name in dataLabel
     *
     * @param string|int $fontWeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsNameFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.name.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * Color of the name in the donut’s label
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsNameColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('plotOptions.pie.donut.labels.name.color', $color);

        return $this;
    }

    /**
     * Sets the top offset for name
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsNameOffsetY(int $offsetY): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.name.offsetY', $offsetY);

        return $this;
    }

    /**
     * A custom formatter function to apply on the name text in dataLabel
     *
     * @note available parameters 'value'
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsNameFormatter(string $functionBody): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.name.formatter', $this->_buildJsFunction($functionBody, ['value']));

        return $this;
    }

    /**
     * Show the value label associated with the name label
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsValueShow(bool $show): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.value.show', $show);

        return $this;
    }

    /**
     * FontSize of the value label
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsValueFontSize(string $fontSize): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.value.fontSize', $fontSize);

        return $this;
    }

    /**
     * FontFamily of the value label
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsValueFontFamily(string $fontFamily): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.value.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * Font weight of the value label in dataLabel
     *
     * @param string|int $fontWeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsValueFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.value.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * Color of the value label in dataLabel
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsValueColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('plotOptions.pie.donut.labels.value.color', $color);

        return $this;
    }

    /**
     * Sets the top offset for value label
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsValueOffsetY(int $offsetY): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.value.offsetY', $offsetY);

        return $this;
    }

    /**
     * A custom formatter function to apply on the value label in dataLabel
     *
     * @note available parameters 'value'
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsValueFormatter(string $functionBody): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.value.formatter', $this->_buildJsFunction($functionBody, ['value']));

        return $this;
    }

    /**
     * Show the total of all the series in the inner area of radialBar
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsTotalShow(bool $show): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.total.show', $show);

        return $this;
    }

    /**
     * Always show the total label and do not remove it even when user clicks/hovers over the slices.
     *
     * @param bool $showAlways
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsTotalShowAlways(bool $showAlways): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.total.showAlways', $showAlways);

        return $this;
    }

    /**
     * Label for “total”. Defaults to “Total”
     *
     * @param string $label
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsTotalLabel(string $label): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.total.label', $label);

        return $this;
    }

    /**
     * FontSize of the total label
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsTotalFontSize(string $fontSize): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.total.fontSize', $fontSize);

        return $this;
    }

    /**
     * FontFamily of the total label
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsTotalFontFamily(string $fontFamily): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.total.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * font-weight of the total label in dataLabel
     *
     * @param string|int $fontWeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsTotalFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.total.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * Color of the total label
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsTotalColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('plotOptions.pie.donut.labels.total.color', $color);

        return $this;
    }

    /**
     * A custom formatter function to apply on the total value. It accepts one parameter w which contains the chart’s config and global objects.
     * Defaults to a total of all series percentage divided by the length of series.
     *
     * @note available parameters 'value'
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPieTrait
     */
    public function setPlotOptionsPieDonutLabelsTotalFormatter(string $functionBody): self
    {
        $this->setConfig('plotOptions.pie.donut.labels.total.formatter', $this->_buildJsFunction($functionBody, ['value']));

        return $this;
    }

}