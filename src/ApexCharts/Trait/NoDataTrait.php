<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait NoDataTrait
{

    /**
     * The text to display when no-data is available. Defaults to undefined which displays nothing.
     *
     * @param string $text
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\NoDataTrait
     */
    public function setNoDataText(string $text): self
    {
        $this->setConfig('noData.text', $text);

        return $this;
    }

    /**
     * Available Options
     *  - left
     *  - center
     *  - right
     *
     * @param string $align
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\NoDataTrait
     */
    public function setNoDataAlign(string $align): self
    {
        $valid = ['left', 'center', 'right'];
        if (!in_array($align, $valid)) {
            throw new ApexChartWrongOptionException('noData.align', $align, $valid);
        }
        $this->setConfig('noData.align', $align);

        return $this;
    }

    /**
     * Available Options
     *  - top
     *  - middle
     *  - bottom
     *
     * @param string $verticalAlign
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\NoDataTrait
     */
    public function setNoDataVerticalAlign(string $verticalAlign): self
    {
        $valid = ['top', 'middle', 'bottom'];
        if (!in_array($verticalAlign, $valid)) {
            throw new ApexChartWrongOptionException('noData.verticalAlign', $verticalAlign, $valid);
        }
        $this->setConfig('noData.verticalAlign', $verticalAlign);

        return $this;
    }

    /**
     * text offset from left
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\NoDataTrait
     */
    public function setNoDataOffsetX(int $offsetX): self
    {
        $this->setConfig('noData.offsetX', $offsetX);

        return $this;
    }

    /**
     * text offset from top
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\NoDataTrait
     */
    public function setNoDataOffsetY(int $offsetY): self
    {
        $this->setConfig('noData.offsetY', $offsetY);

        return $this;
    }

    /**
     * ForeColor of the text
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\NoDataTrait
     */
    public function setNoDataStyleColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('noData.style.color', $color);

        return $this;
    }

    /**
     * FontSize of the text
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\NoDataTrait
     */
    public function setNoDataStyleFontSize(string $fontSize): self
    {
        $this->setConfig('noData.style.fontSize', $fontSize);

        return $this;
    }

    /**
     * FontFamily of the text
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\NoDataTrait
     */
    public function setNoDataStyleFontFamily(string $fontFamily): self
    {
        $this->setConfig('noData.style.fontFamily', $fontFamily);

        return $this;
    }
}