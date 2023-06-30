<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Entity;


use Cake\Core\InstanceConfigTrait;
use Toolkit\Exception\ApexChartWrongOptionException;

class AnnotationText
{
    use InstanceConfigTrait;

    /**
     * Default config for annotation.
     *
     * @var array
     */
    protected array $_defaultConfig = [];

    /**
     * X (left) position for the text relative to the element specified in appendTo property
     *
     * @param float|int|string $x
     * @return $this
     */
    public function setX(float|int|string $x): self
    {
        $this->setConfig('x', $x);

        return $this;
    }

    /**
     * Y (top) position for the text relative to the element specified in appendTo property
     *
     * @param float|int $y
     * @return $this
     */
    public function setY(float|int $y): self
    {
        $this->setConfig('y', $y);

        return $this;
    }

    /**
     * The main text to be displayed
     *
     * @param string $text
     * @return $this
     */
    public function setText(string $text): self
    {
        $this->setConfig('text', $text);

        return $this;
    }

    /**
     * The alignment of text relative to label’s drawing position
     * Accepted values:
     *  - start
     *  - middle
     *  - end
     *
     * @param string $textAnchor
     * @return $this
     */
    public function setTextAnchor(string $textAnchor): self
    {
        $valid = ['start', 'middle', 'end'];
        if (!in_array($textAnchor, $valid)) {
            throw new ApexChartWrongOptionException('textAnchor', $textAnchor, $valid);
        }
        $this->setConfig('textAnchor', $textAnchor);

        return $this;
    }

    /**
     * ForeColor for the annotation label
     *
     * @param string $color
     * @return $this
     */
    public function setColor(string $color): self
    {
        $this->setConfig('color', $color);

        return $this;
    }

    /**
     * FontSize for the annotation label
     *
     * @param string $fontSize
     * @return $this
     */
    public function setFontSize(string $fontSize): self
    {
        $this->setConfig('fontSize', $fontSize);

        return $this;
    }

    /**
     * Font-weight for the annotation label
     *
     * @param string|int $fontWeight
     * @return $this
     */
    public function setFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('fontWeight', $fontWeight);

        return $this;
    }

    /**
     * Font-family for the annotation label
     *
     * @param string $fontFamily
     * @return $this
     */
    public function setFontFamily(string $fontFamily): self
    {
        $this->setConfig('fontFamily', $fontFamily);

        return $this;
    }

    /**
     * A query selector to which the text element will be appended.
     *
     * @param string $appendTo
     * @return $this
     */
    public function setAppendTo(string $appendTo): self
    {
        $this->setConfig('appendTo', $appendTo);

        return $this;
    }

    /**
     * Border Color for the label
     *
     * @param string $borderColor
     * @return $this
     */
    public function setBorderColor(string $borderColor): self
    {
        $this->setConfig('fontSize', $borderColor);

        return $this;
    }

    /**
     * Border Radius for the label
     *
     * @param int $borderRadius
     * @return $this
     */
    public function setBorderRadius(int $borderRadius): self
    {
        $this->setConfig('borderRadius', $borderRadius);

        return $this;
    }

    /**
     * Border width for the label
     *
     * @param int $borderWidth
     * @return $this
     */
    public function setBorderWidth(int $borderWidth): self
    {
        $this->setConfig('borderWidth', $borderWidth);

        return $this;
    }

    /**
     * Left padding for the label
     *
     * @param int $paddingLeft
     * @return $this
     */
    public function setPaddingLeft(int $paddingLeft): self
    {
        $this->setConfig('paddingLeft', $paddingLeft);

        return $this;
    }

    /**
     * Right padding for the label
     *
     * @param int $paddingRight
     * @return $this
     */
    public function setPaddingRight(int $paddingRight): self
    {
        $this->setConfig('paddingRight', $paddingRight);

        return $this;
    }

    /**
     * Top padding for the label
     *
     * @param int $paddingTop
     * @return $this
     */
    public function setPaddingTop(int $paddingTop): self
    {
        $this->setConfig('paddingTop', $paddingTop);

        return $this;
    }

    /**
     * Bottom padding for the label
     *
     * @param int $paddingBottom
     * @return $this
     */
    public function setPaddingBottom(int $paddingBottom): self
    {
        $this->setConfig('paddingBottom', $paddingBottom);

        return $this;
    }


}