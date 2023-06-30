<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Cake\Error\FatalErrorException;
use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait FillTrait
{

    /**
     * Colors to fill the svg paths. Each index in the array corresponds to the series-index
     *
     * @param array $colors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillColors(array $colors): self
    {
        foreach ($colors as $color) {
            Colors::validateColorOrFail($color);
        }
        $this->setConfig('fill.colors', $colors);

        return $this;
    }

    /**
     * Opacity of the fill attribute.
     *
     * @param float $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillOpacity(float $opacity): self
    {
        $this->setConfig('fill.colors', $opacity);

        return $this;
    }

    /**
     * Whether to fill the paths with solid colors or gradient.
     * Available options:
     *  - solid
     *  - gradient
     *  - pattern
     *  - image
     *
     * In a multi-series chart, you can pass an array to allow a combination of fill types
     *
     * @param string|array $type
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillType(string|array $type): self
    {
        $valid = ['solid', 'gradient', 'pattern', 'image'];
        if (is_array($type)) {
            foreach ($type as $item) {
                if (!in_array($item, $valid)) {
                    throw new ApexChartWrongOptionException('fill.type', $item, $valid);
                }
            }
        } else {
            if (!in_array($type, $valid)) {
                throw new ApexChartWrongOptionException('fill.type', $type, $valid);
            }
        }
        $this->setConfig('fill.type', $type);

        return $this;
    }

    /**
     * Available options for gradient shade:
     *  - light
     *  - dark
     *
     * @param string $shade
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillGradientShade(string $shade): self
    {
        $valid = ['light', 'dark'];
        if (!in_array($shade, $valid)) {
            throw new ApexChartWrongOptionException('fill.type', $shade, $valid);
        }
        $this->setConfig('fill.gradient.shade', $shade);

        return $this;
    }

    /**
     * Available options for gradient type:
     *  - horizontal
     *  - vertical
     *  - diagonal1
     *  - diagonal2
     *
     * @param string $type
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillGradientType(string $type): self
    {
        $valid = ['horizontal', 'vertical', 'diagonal1', 'diagonal2'];
        if (!in_array($type, $valid)) {
            throw new ApexChartWrongOptionException('fill.type', $type, $valid);
        }
        $this->setConfig('fill.gradient.type', $type);

        return $this;
    }

    /**
     * Intensity of the gradient shade.
     * Accepts from 0 to 1
     *
     * @param float $shadeIntensity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillGradientShadeIntensity(float $shadeIntensity): self
    {
        if ($shadeIntensity > 1 || $shadeIntensity < 0) {
            throw new FatalErrorException('Shade Intensity must to be between 0 and 1');
        }
        $this->setConfig('fill.gradient.shadeIntensity', $shadeIntensity);

        return $this;
    }

    /**
     * Optional colors that ends the gradient to.
     * The main colors array becomes the gradientFromColors and this array becomes the end colors of the gradient.
     * Each index in the array corresponds to the series-index.
     *
     * @param array $gradientToColors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillGradientGradientToColors(array $gradientToColors): self
    {
        foreach ($gradientToColors as $gradientToColor) {
            Colors::validateColorOrFail($gradientToColor);
        }
        $this->setConfig('fill.gradient.gradientToColors', $gradientToColors);

        return $this;
    }

    /**
     * Inverse the start and end colors of the gradient.
     *
     * @param bool $inverseColors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillGradientInverseColors(bool $inverseColors): self
    {
        $this->setConfig('fill.gradient.inverseColors', $inverseColors);

        return $this;
    }

    /**
     * Start color's opacity. If you want different opacity for different series, you can pass an array of numbers.
     * For eg., opacityFrom: [0.2, 0.8]
     *
     * @param float|array $opacityFrom
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillGradientOpacityFrom(float|array $opacityFrom): self
    {
        if (is_array($opacityFrom)) {
            foreach ($opacityFrom as $item) {
                if (!is_numeric($item)) {
                    throw new FatalErrorException('Opacity array item must to be a number');
                }
            }
        }
        $this->setConfig('fill.gradient.opacityFrom', $opacityFrom);

        return $this;
    }

    /**
     * End color's opacity
     *
     * @param float|array $opacityTo
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillGradientOpacityTo(float|array $opacityTo): self
    {
        if (is_array($opacityTo)) {
            foreach ($opacityTo as $item) {
                if (!is_numeric($item)) {
                    throw new FatalErrorException('Opacity array item must to be a number');
                }
            }
        }
        $this->setConfig('fill.gradient.opacityTo', $opacityTo);

        return $this;
    }

    /**
     * Stops defines the ramp of colors to use on a gradient
     *
     * @param array $stops
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillGradientStops(array $stops): self
    {
        $this->setConfig('fill.gradient.stops', $stops);

        return $this;
    }

    /**
     * Override everything and define your own stops with unlimited color stops.
     *
     * @param array $colorStops
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillGradientColorStops(array $colorStops): self
    {
        $this->setConfig('fill.gradient.colorStops', $colorStops);

        return $this;
    }

    /**
     * src accepts an array of image paths which will correspond to each series.
     *
     * @param array $src
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillImageSrc(array $src): self
    {
        $this->setConfig('fill.image.src', $src);

        return $this;
    }

    /**
     * Width of each image for all the series
     *
     * @param int $width
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillImageWidth(int $width): self
    {
        $this->setConfig('fill.image.width', $width);

        return $this;
    }

    /**
     * Height of each image for all the series
     *
     * @param int $height
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillImageHeight(int $height): self
    {
        $this->setConfig('fill.image.height', $height);

        return $this;
    }

    /**
     * Available pattern styles:
     *  - verticalLines
     *  - horizontalLines
     *  - slantedLines
     *  - squares
     *  - circles
     *
     * @param string $style
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillPatternStyle(string $style): self
    {
        $valid = ['verticalLines', 'horizontalLines', 'slantedLines', 'squares', 'circles'];
        if (!in_array($style, $valid)) {
            throw new ApexChartWrongOptionException('fill.pattern.style', $style, $valid);
        }
        $this->setConfig('fill.pattern.style', $style);

        return $this;
    }

    /**
     * Pattern width which will be repeated at this interval
     *
     * @param int $width
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillPatternWidth(int $width): self
    {
        $this->setConfig('fill.pattern.width', $width);

        return $this;
    }

    /**
     * Pattern height which will be repeated at this interval
     *
     * @param int $height
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillPatternHeight(int $height): self
    {
        $this->setConfig('fill.pattern.height', $height);

        return $this;
    }

    /**
     * Pattern lines width indicates the thickness of the stroke of pattern.
     *
     * @param int $strokeWidth
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\DataLabelsTrait
     */
    public function setFillPatternStrokeWidth(int $strokeWidth): self
    {
        $this->setConfig('fill.pattern.strokeWidth', $strokeWidth);

        return $this;
    }

}