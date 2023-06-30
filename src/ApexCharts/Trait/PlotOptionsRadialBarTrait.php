<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait PlotOptionsRadialBarTrait
{

    /**
     * A custom size for the inner radar. The default size calculation will be overrided with this
     *
     * @param bool $inverseOrder
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarInverseOrder(bool $inverseOrder): self
    {
        $this->setConfig('plotOptions.radialBar.inverseOrder', $inverseOrder);

        return $this;
    }

    /**
     * Angle from which the radialBars should start
     *
     * @param int $startAngle
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarStartAngle(int $startAngle): self
    {
        $this->setConfig('plotOptions.radialBar.startAngle', $startAngle);

        return $this;
    }

    /**
     * Angle to which the radialBars should end. The sum of the startAngle and endAngle should not exceed 360.
     *
     * @param int $endAngle
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarEndAngle(int $endAngle): self
    {
        $this->setConfig('plotOptions.radialBar.endAngle', $endAngle);

        return $this;
    }

    /**
     * Sets the left offset for radialBars
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarOffsetX(int $offsetX): self
    {
        $this->setConfig('plotOptions.radialBar.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset for radialBars
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarOffsetY(int $offsetY): self
    {
        $this->setConfig('plotOptions.radialBar.offsetY', $offsetY);

        return $this;
    }

    /**
     * Spacing which will be subtracted from the available hollow size
     *
     * @param int $margin
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarHollowMargin(int $margin): self
    {
        $this->setConfig('plotOptions.radialBar.hollow.margin', $margin);

        return $this;
    }

    /**
     * Size in percentage relative to the total available size of chart
     *
     * @param string $size
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarHollowSize(string $size): self
    {
        $this->setConfig('plotOptions.radialBar.hollow.size', $size);

        return $this;
    }

    /**
     * Background color for the hollow part of the radialBars
     *
     * @param string $background
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarHollowBackground(string $background): self
    {
        Colors::validateColorOrFail($background);
        $this->setConfig('plotOptions.radialBar.hollow.background', $background);

        return $this;
    }

    /**
     * Optional image URL which can be displayed in the hollow area.
     *
     * @param string $image
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarHollowImage(string $image): self
    {
        $this->setConfig('plotOptions.radialBar.hollow.image', $image);

        return $this;
    }

    /**
     * Width of the hollow image
     *
     * @param int $imageWidth
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarHollowImageWidth(int $imageWidth): self
    {
        $this->setConfig('plotOptions.radialBar.hollow.imageWidth', $imageWidth);

        return $this;
    }

    /**
     * Height of the hollow image
     *
     * @param int $imageHeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarHollowImageHeight(int $imageHeight): self
    {
        $this->setConfig('plotOptions.radialBar.hollow.imageHeight', $imageHeight);

        return $this;
    }

    /**
     * Sets the left offset of hollow image
     *
     * @param int $imageOffsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarHollowImageOffsetX(int $imageOffsetX): self
    {
        $this->setConfig('plotOptions.radialBar.hollow.imageOffsetX', $imageOffsetX);

        return $this;
    }

    /**
     * Sets the top offset of hollow image
     *
     * @param int $imageOffsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarHollowImageOffsetY(int $imageOffsetY): self
    {
        $this->setConfig('plotOptions.radialBar.hollow.imageOffsetY', $imageOffsetY);

        return $this;
    }

    /**
     * If true, the image doesn’t exceeds the hollow area and is contained within.
     *
     * @param bool $imageClipped
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarHollowImageClipped(bool $imageClipped): self
    {
        $this->setConfig('plotOptions.radialBar.hollow.imageClipped', $imageClipped);

        return $this;
    }

    /**
     * Available Options:
     *  - front
     *  - back
     *
     * @param string $position
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarHollowPosition(string $position): self
    {
        $valid = ['front', 'back'];
        if (!in_array($position, $valid)) {
            throw new ApexChartWrongOptionException('plotOptions.radialBar.hollow.position', $position, $valid);
        }
        $this->setConfig('plotOptions.radialBar.hollow.position', $position);

        return $this;
    }

    /**
     * Enable a dropshadow for paths of the SVG
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDropShadowEnabled(bool $enabled): self
    {
        $this->setConfig('plotOptions.radialBar.dropShadow.enabled', $enabled);

        return $this;
    }

    /**
     * Set top offset for shadow
     *
     * @param int $top
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDropShadowTop(int $top): self
    {
        $this->setConfig('plotOptions.radialBar.dropShadow.top', $top);

        return $this;
    }

    /**
     * Set left offset for shadow
     *
     * @param int $left
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDropShadowLeft(int $left): self
    {
        $this->setConfig('plotOptions.radialBar.dropShadow.left', $left);

        return $this;
    }

    /**
     * Set blur distance for shadow
     *
     * @param float $blur
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDropShadowBlur(float $blur): self
    {
        $this->setConfig('plotOptions.radialBar.dropShadow.blur', $blur);

        return $this;
    }

    /**
     * Set the opacity of shadow.
     *
     * @param float $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDropShadowOpacity(float $opacity): self
    {
        $this->setConfig('plotOptions.radialBar.dropShadow.opacity', $opacity);

        return $this;
    }

    /**
     * Show track under the bar lines.
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarTrackShow(bool $show): self
    {
        $this->setConfig('plotOptions.radialBar.track.show', $show);

        return $this;
    }

    /**
     * Angle from which the track should start.
     *
     * @param int $startAngle
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarTrackStartAngle(int $startAngle): self
    {
        $this->setConfig('plotOptions.radialBar.track.startAngle', $startAngle);

        return $this;
    }

    /**
     * Angle to which the track should end.
     *
     * @param int $endAngle
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarTrackEndAngle(int $endAngle): self
    {
        $this->setConfig('plotOptions.radialBar.track.endAngle', $endAngle);

        return $this;
    }

    /**
     * Color of the track. If you want different color for each track, you can pass an array of colors.
     *
     * @param string|array $background
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarTrackBackground(string|array $background): self
    {
        if (is_array($background)) {
            foreach ($background as $item) {
                Colors::validateColorOrFail($item);
            }
        } else {
            Colors::validateColorOrFail($background);
        }
        $this->setConfig('plotOptions.radialBar.track.background', $background);

        return $this;
    }

    /**
     * Width of the track
     *
     * @param int $width
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarTrackWidth(int $width): self
    {
        $this->setConfig('plotOptions.radialBar.track.width', $width);

        return $this;
    }

    /**
     * Opacity of the track
     *
     * @param int $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarTrackOpacity(int $opacity): self
    {
        $this->setConfig('plotOptions.radialBar.track.opacity', $opacity);

        return $this;
    }

    /**
     * Spacing between each track
     *
     * @param int $margin
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarTrackMargin(int $margin): self
    {
        $this->setConfig('plotOptions.radialBar.track.margin', $margin);

        return $this;
    }

    /**
     * Whether to display labels inside radialBars or not
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsShow(bool $show): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.show', $show);

        return $this;
    }

    /**
     * Show the name of the respective bar associated with it’s value
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsNameShow(bool $show): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.name.show', $show);

        return $this;
    }

    /**
     * FontSize of the name in dataLabel
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsNameFontSize(string $fontSize): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.name.fontSize', $fontSize);

        return $this;
    }

    /**
     * FontFamily of the name in dataLabel
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsNameFontFamily(string $fontFamily): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.name.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * Font-weight of the name in dataLabel
     *
     * @param string|int $fontWeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsNameFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.name.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * Color of the name in dataLabel
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsNameColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('plotOptions.radialBar.dataLabels.name.color', $color);

        return $this;
    }

    /**
     * Sets the top offset for name
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsNameOffsetY(int $offsetY): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.name.offsetY', $offsetY);

        return $this;
    }

    /**
     * Show the value label associated with the name label
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsValueShow(bool $show): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.value.show', $show);

        return $this;
    }

    /**
     * FontSize of the value label in dataLabel
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsValueFontSize(string $fontSize): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.value.fontSize', $fontSize);

        return $this;
    }

    /**
     * fontFamily of the value label in dataLabel
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsValueFontFamily(string $fontFamily): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.value.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * Font weight of the value label in dataLabel
     *
     * @param string|int $fontWeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsValueFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.value.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * Color of the value label in dataLabel
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsValueColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('plotOptions.radialBar.dataLabels.value.color', $color);

        return $this;
    }

    /**
     * Sets the top offset for value label
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsValueOffsetY(int $offsetY): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.value.offsetY', $offsetY);

        return $this;
    }

    /**
     * A custom formatter function to apply on the value label in dataLabel
     *
     * @note available parameters 'value'
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsValueFormatter(string $functionBody): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.value.formatter', $this->_buildJsFunction($functionBody, ['value']));

        return $this;
    }

    /**
     * Show the total of all the series in the inner area of radialBar
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsTotalShow(bool $show): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.total.show', $show);

        return $this;
    }

    /**
     * Label for “total”. Defaults to “Total”
     *
     * @param string $label
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsTotalLabel(string $label): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.total.label', $label);

        return $this;
    }

    /**
     * Color of the total label
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsTotalColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('plotOptions.radialBar.dataLabels.total.color', $color);

        return $this;
    }

    /**
     * Font-size of the total label in dataLabel
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsTotalFontSize(string $fontSize): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.total.fontSize', $fontSize);

        return $this;
    }

    /**
     * FontFamily of the total label
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsTotalFontFamily(string $fontFamily): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.total.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * font-weight of the total label in dataLabel
     *
     * @param string|int $fontWeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsTotalFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.total.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * A custom formatter function to apply on the total value. It accepts one parameter w which contains the chart’s config and global objects.
     * Defaults to a total of all series percentage divided by the length of series.
     *
     * @note available parameters 'value'
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait
     */
    public function setPlotOptionsRadialBarDataLabelsTotalFormatter(string $functionBody): self
    {
        $this->setConfig('plotOptions.radialBar.dataLabels.total.formatter', $this->_buildJsFunction($functionBody, ['value']));

        return $this;
    }

}