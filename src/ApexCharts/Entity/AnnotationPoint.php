<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Entity;


use Cake\Core\InstanceConfigTrait;
use Toolkit\Exception\ApexChartWrongOptionException;

class AnnotationPoint
{
    use InstanceConfigTrait;

    /**
     * Default config for annotation.
     *
     * @var array
     */
    protected array $_defaultConfig = [];

    /**
     * X Value on which the annotation will be drawn (can be either timestamp for datetime x-axis or string category for category x-axis)
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
     * Y Value on which the annotation will be drawn
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
     * When there are multiple y-axis, setting this options will put the point annotation for that particular y-axis’ y value
     *
     * @param int $yAxisIndex
     * @return $this
     */
    public function setYAxisIndex(int $yAxisIndex): self
    {
        $this->setConfig('yAxisIndex', $yAxisIndex);

        return $this;
    }

    /**
     * In a multiple series, you will have to specify which series the annotation’s y value belongs to. Not required for single series
     *
     * @param int $seriesIndex
     * @return $this
     */
    public function setSeriesIndex(int $seriesIndex): self
    {
        $this->setConfig('seriesIndex', $seriesIndex);

        return $this;
    }

    /**
     * Size of the marker.
     *
     * @param int $size
     * @return $this
     */
    public function setMarkerSize(int $size): self
    {
        $this->setConfig('marker.size', $size);

        return $this;
    }

    /**
     * Fill Color of the marker point.
     *
     * @param string $fillColor
     * @return $this
     */
    public function setMarkerFillColor(string $fillColor): self
    {
        $this->setConfig('marker.fillColor', $fillColor);

        return $this;
    }

    /**
     * Stroke Color of the marker point.
     *
     * @param string $strokeColor
     * @return $this
     */
    public function setMarkerStrokeColor(string $strokeColor): self
    {
        $this->setConfig('marker.strokeColor', $strokeColor);

        return $this;
    }

    /**
     * Stroke Size of the marker point.
     *
     * @param int $strokeWidth
     * @return $this
     */
    public function setMarkerStrokeWidth(int $strokeWidth): self
    {
        $this->setConfig('marker.strokeWidth', $strokeWidth);

        return $this;
    }

    /**
     * Shape of the marker.
     * Available Options for shape:
     *  - circle
     *  - square
     *
     * @param string $shape
     * @return $this
     */
    public function setMarkerShape(string $shape): self
    {
        $valid = ['circle', 'square'];
        if (!in_array($shape, $valid)) {
            throw new ApexChartWrongOptionException('shape', $shape, $valid);
        }
        $this->setConfig('marker.shape', $shape);

        return $this;
    }

    /**
     * Radius of the marker (applies to square shape)
     *
     * @param int $radius
     * @return $this
     */
    public function setMarkerRadius(int $radius): self
    {
        $this->setConfig('marker.radius', $radius);

        return $this;
    }

    /**
     * Sets the left offset of the marker
     *
     * @param int $offsetX
     * @return $this
     */
    public function setMarkerOffsetX(int $offsetX): self
    {
        $this->setConfig('marker.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset of the marker
     *
     * @param int $offsetY
     * @return $this
     */
    public function setMarkerOffsetY(int $offsetY): self
    {
        $this->setConfig('marker.offsetY', $offsetY);

        return $this;
    }

    /**
     * Additional CSS classes to append to the marker
     *
     * @param string $cssClass
     * @return $this
     */
    public function setMarkerCssClass(string $cssClass): self
    {
        $this->setConfig('marker.cssClass', $cssClass);

        return $this;
    }

    /**
     * Border Color of the label
     *
     * @param string $borderColor
     * @return $this
     */
    public function setLabelBorderColor(string $borderColor): self
    {
        $this->setConfig('label.borderColor', $borderColor);

        return $this;
    }

    /**
     * Border width of the label
     *
     * @param int $borderWidth
     * @return $this
     */
    public function setLabelBorderWidth(int $borderWidth): self
    {
        $this->setConfig('label.borderWidth', $borderWidth);

        return $this;
    }

    /**
     * Border-radius of the label
     *
     * @param int $borderRadius
     * @return $this
     */
    public function setLabelBorderRadius(int $borderRadius): self
    {
        $this->setConfig('label.borderRadius', $borderRadius);

        return $this;
    }

    /**
     * Text for tha annotation label
     *
     * @param string $text
     * @return $this
     */
    public function setLabelText(string $text): self
    {
        $this->setConfig('label.text', $text);

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
    public function setLabelTextAnchor(string $textAnchor): self
    {
        $valid = ['start', 'middle', 'end'];
        if (!in_array($textAnchor, $valid)) {
            throw new ApexChartWrongOptionException('textAnchor', $textAnchor, $valid);
        }
        $this->setConfig('label.textAnchor', $textAnchor);

        return $this;
    }

    /**
     * Sets the left offset for annotation label
     *
     * @param int $offsetX
     * @return $this
     */
    public function setLabelOffsetX(int $offsetX): self
    {
        $this->setConfig('label.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset for annotation label
     *
     * @param int $offsetY
     * @return $this
     */
    public function setLabelOffsetY(int $offsetY): self
    {
        $this->setConfig('label.offsetY', $offsetY);

        return $this;
    }

    /**
     * Background Color for the annotation label
     *
     * @param string $background
     * @return $this
     */
    public function setLabelStyleBackground(string $background): self
    {
        $this->setConfig('label.style.background', $background);

        return $this;
    }

    /**
     * FontSize for the annotation label
     *
     * @param string $color
     * @return $this
     */
    public function setLabelStyleColor(string $color): self
    {
        $this->setConfig('label.style.color', $color);

        return $this;
    }

    /**
     * Text for tha annotation label
     *
     * @param string $fontSize
     * @return $this
     */
    public function setLabelStyleFontSize(string $fontSize): self
    {
        $this->setConfig('label.style.fontSize', $fontSize);

        return $this;
    }

    /**
     * Font-weight for the annotation label
     *
     * @param string|int $fontWeight
     * @return $this
     */
    public function setLabelStyleFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('label.style.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * Font-family for the annotation label
     *
     * @param string $fontFamily
     * @return $this
     */
    public function setLabelStyleFontFamily(string $fontFamily): self
    {
        $this->setConfig('label.style.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * A custom Css Class to give to the annotation label elements
     *
     * @param string $cssClass
     * @return $this
     */
    public function setLabelStyleCssClass(string $cssClass): self
    {
        $this->setConfig('label.style.cssClass', $cssClass);

        return $this;
    }

    /**
     * Left padding for the label
     *
     * @param int $left
     * @return $this
     */
    public function setLabelStylePaddingLeft(int $left): self
    {
        $this->setConfig('label.style.padding.left', $left);

        return $this;
    }

    /**
     * Right padding for the label
     *
     * @param int $right
     * @return $this
     */
    public function setLabelStylePaddingRight(int $right): self
    {
        $this->setConfig('label.style.padding.right', $right);

        return $this;
    }

    /**
     * Top padding for the label
     *
     * @param int $top
     * @return $this
     */
    public function setLabelStylePaddingTop(int $top): self
    {
        $this->setConfig('label.style.padding.top', $top);

        return $this;
    }

    /**
     * Bottom padding for the label
     *
     * @param int $bottom
     * @return $this
     */
    public function setLabelStylePaddingBottom(int $bottom): self
    {
        $this->setConfig('label.style.padding.bottom', $bottom);

        return $this;
    }

    /**
     * Provide a full path of the image to display in place of annotation.
     *
     * @param string $path
     * @return $this
     */
    public function setImagePath(string $path): self
    {
        $this->setConfig('image.path', $path);

        return $this;
    }

    /**
     * Width of image annotation.
     *
     * @param int width
     * @return $this
     */
    public function setImageWidth(int $width): self
    {
        $this->setConfig('image.width', $width);

        return $this;
    }

    /**
     * Height of image annotation.
     *
     * @param int $height
     * @return $this
     */
    public function setImageHeight(int $height): self
    {
        $this->setConfig('image.height', $height);

        return $this;
    }

    /**
     * Left offset of the image.
     *
     * @param int $offsetX
     * @return $this
     */
    public function setImageOffsetX(int $offsetX): self
    {
        $this->setConfig('image.offsetX', $offsetX);

        return $this;
    }

    /**
     * Top offset of the image.
     *
     * @param int $offsetY
     * @return $this
     */
    public function setImageOffsetY(int $offsetY): self
    {
        $this->setConfig('image.offsetY', $offsetY);

        return $this;
    }
}