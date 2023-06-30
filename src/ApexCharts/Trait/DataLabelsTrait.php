<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Cake\Error\FatalErrorException;
use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait DataLabelsTrait
{

    /**
     * @var array
     */
    protected array $_chatToolbarCustomIcons = [];

    /**
     * To determine whether to show dataLabels or not
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsEnabled(bool $enabled): self
    {
        $this->setConfig('dataLabels.enabled', $enabled);

        return $this;
    }

    /**
     * Allows showing series only on specific series in a multi-series chart.
     * For eg., if you have a line and a column chart, you can show dataLabels only on the line chart by specifying it’s index in this array property.
     *
     * @param array $enabledOnSeries
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsEnabledOnSeries(array $enabledOnSeries): self
    {
        foreach ($enabledOnSeries as $enabledOnSerie) {
            if (!is_numeric($enabledOnSerie)) {
                throw new FatalErrorException('Invalid serie type');
            }
        }
        $this->setConfig('dataLabels.enabledOnSeries', $enabledOnSeries);

        return $this;
    }

    /**
     * The formatter function allows you to modify the value before displaying
     *
     * Parameter seriesIndex is useful in multi-series chart, while dataPointIndex is the index of data-point in that series.
     * w is an object consisting all globals and configuration which can be utilized the way mentioned in the above code.
     *
     * @note available parameters 'value', '{seriesIndex, dataPointIndex, w}'
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsFormatter(string $functionBody): self
    {

        $this->setConfig('dataLabels.formatter', $this->_buildJsFunction($functionBody, ['value', '{seriesIndex, dataPointIndex, w}']));

        return $this;
    }

    /**
     * The alignment of text relative to dataLabel’s drawing position
     * Accepted values:
     *  - start
     *  - middle
     *  - end
     *
     * @param string $textAnchor
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsTextAnchor(string $textAnchor): self
    {
        $valid = ['start', 'middle', 'end'];
        if (!in_array($textAnchor, $valid)) {
            throw new ApexChartWrongOptionException('dataLabels.textAnchor', $textAnchor, $valid);
        }
        $this->setConfig('dataLabels.textAnchor', $textAnchor);

        return $this;
    }

    /**
     * Similar to plotOptions.bar.distributed, this option makes each data-label discrete.
     * So, when you provide an array of colors in datalabels.style.colors, the index in the colors
     * array correlates with individual data-label index of all series.
     *
     * @param bool $distributed
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsDistributed(bool $distributed): self
    {
        $this->setConfig('dataLabels.distributed', $distributed);

        return $this;
    }

    /**
     * Sets the left offset for dataLabels
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsOffsetX(int $offsetX): self
    {
        $this->setConfig('dataLabels.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset for dataLabels
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsOffsetY(int $offsetY): self
    {
        $this->setConfig('dataLabels.offsetY', $offsetY);

        return $this;
    }

    /**
     * FontSize for the label
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsStyleFontSize(string $fontSize): self
    {
        $this->setConfig('dataLabels.style.fontSize', $fontSize);

        return $this;
    }

    /**
     * FontFamily for the label
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsStyleFontFamily(string $fontFamily): self
    {
        $this->setConfig('dataLabels.style.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * Font weight for the label. Can be String (‘bold’) or number (400/500)
     *
     * @param string|int $fontWeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsStyleFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('dataLabels.style.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * ForeColors for the dataLabels. Accepts an array of string colors (['#333', '#999'])
     *
     * @param array $colors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsStyleColors(array $colors): self
    {
        foreach ($colors as $color) {
            Colors::validateColorOrFail($color);
        }
        $this->setConfig('dataLabels.style.colors', $colors);

        return $this;
    }

    /**
     * Should draw a background rectangle around the label
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsBackgroundEnabled(bool $enabled): self
    {
        $this->setConfig('dataLabels.background.enabled', $enabled);

        return $this;
    }

    /**
     * Color of the label when background is enabled. This will override the colors above in style key.
     *
     * @param string $foreColor
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsBackgroundForeColor(string $foreColor): self
    {
        Colors::validateColorOrFail($foreColor);
        $this->setConfig('dataLabels.background.foreColor', $foreColor);

        return $this;
    }

    /**
     * Border radius of the background rect.
     *
     * @param int $borderRadius
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsBackgroundBorderRadius(int $borderRadius): self
    {
        $this->setConfig('dataLabels.background.borderRadius', $borderRadius);

        return $this;
    }

    /**
     * Border width of the background rect.
     *
     * @param int $borderWidth
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsBackgroundBorderWidth(int $borderWidth): self
    {
        $this->setConfig('dataLabels.background.borderWidth', $borderWidth);

        return $this;
    }

    /**
     * Border color of the background rect.
     *
     * @param string $borderColor
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsBackgroundBorderColor(string $borderColor): self
    {
        Colors::validateColorOrFail($borderColor);
        $this->setConfig('dataLabels.background.borderColor', $borderColor);

        return $this;
    }

    /**
     * Opacity of the background color.
     *
     * @param float $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsBackgroundOpacity(float $opacity): self
    {
        $this->setConfig('dataLabels.background.opacity', $opacity);

        return $this;
    }

    /**
     * Enable a dropshadow for dataLabels background
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsDropShadowEnabled(bool $enabled): self
    {
        $this->setConfig('dataLabels.dropShadow.enabled', $enabled);

        return $this;
    }

    /**
     * Set top offset for shadow
     *
     * @param int $top
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsDropShadowTop(int $top): self
    {
        $this->setConfig('dataLabels.dropShadow.top', $top);

        return $this;
    }

    /**
     * Set left offset for shadow
     *
     * @param int $left
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsDropShadowLeft(int $left): self
    {
        $this->setConfig('dataLabels.dropShadow.left', $left);

        return $this;
    }

    /**
     * Set blur distance for shadow
     *
     * @param int $blur
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsDropShadowBlur(int $blur): self
    {
        $this->setConfig('dataLabels.dropShadow.blur', $blur);

        return $this;
    }

    /**
     * Set color of the shadow
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsDropShadowColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('dataLabels.dropShadow.color', $color);

        return $this;
    }

    /**
     * Set the opacity of shadow.
     *
     * @param float $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setDataLabelsDropShadowOpacity(float $opacity): self
    {
        $this->setConfig('dataLabels.dropShadow.opacity', $opacity);

        return $this;
    }

}