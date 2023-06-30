<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;

use Toolkit\Exception\ApexChartWrongOptionException;

trait TitleTrait
{

    /**
     * Text to display as a title of chart
     *
     * @param string $text
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TitleTrait
     */
    public function setTitleText(string $text): self
    {
        $this->setConfig('title.text', $text);

        return $this;
    }

    /**
     * Alignment of title relative to chart area.
     * Possible Options:
     *  - left
     *  - center
     *  - right
     *
     * @param string $align
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TitleTrait
     */
    public function setTitleAlign(string $align): self
    {
        $valid = ['left', 'center', 'right'];
        if (!in_array($align, $valid)) {
            throw new ApexChartWrongOptionException('title.align', $align, $valid);
        }
        $this->setConfig('title.align', $align);

        return $this;
    }

    /**
     * Vertical spacing around the title text
     *
     * @param int $margin
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TitleTrait
     */
    public function setTitleMargin(int $margin): self
    {
        $this->setConfig('title.margin', $margin);

        return $this;
    }

    /**
     * Sets the left offset for title text
     *
     * @param int $offset
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TitleTrait
     */
    public function setTitleOffsetX(int $offset): self
    {
        $this->setConfig('title.offsetX', $offset);

        return $this;
    }

    /**
     * Sets the top offset for title text
     *
     * @param int $offset
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TitleTrait
     */
    public function setTitleOffsetY(int $offset): self
    {
        $this->setConfig('title.offsetY', $offset);

        return $this;
    }

    /**
     * The floating option will take out the title text from the chart area and make it float on top of the chart
     *
     * @param bool $floating
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TitleTrait
     */
    public function setTitleFloating(bool $floating): self
    {
        $this->setConfig('title.floating', $floating);

        return $this;
    }

    /**
     * Font Size of the title text
     * ex: 14px
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TitleTrait
     */
    public function setTitleStyleFontSize(string $fontSize): self
    {
        $this->setConfig('title.style.fontSize', $fontSize);

        return $this;
    }

    /**
     * Font Weight of the title text
     * ex: 400|bold
     *
     * @param string|int $fontWeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TitleTrait
     */
    public function setTitleStyleFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('title.style.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * Font Family of the title text
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TitleTrait
     */
    public function setTitleStyleFontFamily(string $fontFamily): self
    {
        $this->setConfig('title.style.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * Fore color of the title text
     * ex: #263238
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\TitleTrait
     */
    public function setTitleStyleColor(string $color): self
    {
        $this->setConfig('title.style.fontFamily', $color);

        return $this;
    }

}