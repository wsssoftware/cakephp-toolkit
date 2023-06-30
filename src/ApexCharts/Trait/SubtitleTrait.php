<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;

trait SubtitleTrait
{

    /**
     * Text to display as a subtitle of chart
     *
     * @param string $text
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setSubtitleText(string $text): self
    {
        $this->setConfig('subtitle.text', $text);

        return $this;
    }

    /**
     * Alignment of subtitle relative to chart area.
     * Possible Options:
     *  - left
     *  - center
     *  - right
     *
     * @param string $align
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setSubtitleAlign(string $align): self
    {
        $valid = ['left', 'center', 'right'];
        if (!in_array($align, $valid)) {
            throw new ApexChartWrongOptionException('subtitle.align', $align, $valid);
        }
        $this->setConfig('subtitle.align', $align);

        return $this;
    }

    /**
     * Vertical spacing around the subtitle text
     *
     * @param int $margin
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setSubtitleMargin(int $margin): self
    {
        $this->setConfig('subtitle.margin', $margin);

        return $this;
    }

    /**
     * Sets the left offset for subtitle text
     *
     * @param int $offset
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setSubtitleOffsetX(int $offset): self
    {
        $this->setConfig('subtitle.offsetX', $offset);

        return $this;
    }

    /**
     * Sets the top offset for subtitle text
     *
     * @param int $offset
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setSubtitleOffsetY(int $offset): self
    {
        $this->setConfig('subtitle.offsetY', $offset);

        return $this;
    }

    /**
     * The floating option will take out the subtitle text from the chart area and make it float on top of the chart
     *
     * @param bool $floating
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setSubtitleFloating(bool $floating): self
    {
        $this->setConfig('subtitle.floating', $floating);

        return $this;
    }

    /**
     * Font Size of the subtitle text
     * ex: 14px
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setSubtitleStyleFontSize(string $fontSize): self
    {
        $this->setConfig('subtitle.style.fontSize', $fontSize);

        return $this;
    }

    /**
     * Font Weight of the subtitle text
     * ex: 400|bold
     *
     * @param string|int $fontWeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setSubtitleStyleFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('subtitle.style.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * Font Family of the subtitle text
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setSubtitleStyleFontFamily(string $fontFamily): self
    {
        $this->setConfig('subtitle.style.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * Fore color of the subtitle text
     * ex: #263238
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setSubtitleStyleColor(string $color): self
    {
        $this->setConfig('subtitle.style.fontFamily', $color);

        return $this;
    }

}