<?php

declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait StrokeTrait
{

    /**
     * To show or hide path-stroke / line
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\StrokeTrait
     */
    public function setStrokeShow(bool $show): self
    {
        $this->setConfig('stroke.show', $show);

        return $this;
    }

    /**
     * In line / area charts, whether to draw smooth lines or straight lines
     * Available Options:
     *  - smooth: connects the points in a curve fashion. Also known as spline
     *  - straight: connect the points in straight lines.
     *  - stepline: points are connected by horizontal and vertical line segments, looking like steps of a staircase.
     * You can also pass an array in stroke.curve, where each index corresponds to the series-index in multi-series charts.
     *
     * @param string|array $curve
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\StrokeTrait
     */
    public function setStrokeCurve(string|array $curve): self
    {
        $valid = ['smooth', 'straight', 'stepline'];
        if (is_array($curve)) {
            foreach ($curve as $item) {
                if (!in_array($item, $valid)) {
                    throw new ApexChartWrongOptionException('stroke.curve', $item, $valid);
                }
            }
        } else {
            if (!in_array($curve, $valid)) {
                throw new ApexChartWrongOptionException('stroke.curve', $curve, $valid);
            }
        }
        $this->setConfig('stroke.curve', $curve);

        return $this;
    }

    /**
     * For setting the starting and ending points of stroke
     * Available Options:
     *  - butt: ends the stroke with a 90-degree angle
     *  - square: similar to butt except that it extends the stroke beyond the length of the path
     *  - round: ends the path-stroke with a radius that smooths out the start and end points
     *
     * @param string $lineCap
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\StrokeTrait
     */
    public function setStrokeLineCap(string $lineCap): self
    {
        $valid = ['butt', 'square', 'round'];
        if (!in_array($lineCap, $valid)) {
            throw new ApexChartWrongOptionException('stroke.curve', $lineCap, $valid);
        }
        $this->setConfig('stroke.lineCap', $lineCap);

        return $this;
    }

    /**
     * Colors to fill the border for paths.
     *
     * @param array $colors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\StrokeTrait
     */
    public function setStrokeColors(array $colors): self
    {
        foreach ($colors as $color) {
            Colors::validateColorOrFail($color);
        }
        $this->setConfig('stroke.colors', $colors);

        return $this;
    }

    /**
     * Sets the width of border for svg path
     *
     * @note array valid only for line/area charts
     * @param int|array $width
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\StrokeTrait
     */
    public function setStrokeWidth(int|array $width): self
    {
        $this->setConfig('stroke.width', $width);

        return $this;
    }

    /**
     * Creates dashes in borders of svg path. Higher number creates more space between dashes in the border.
     *
     * @param int|array $dashArray
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\StrokeTrait
     */
    public function setStrokeDashArray(int|array $dashArray): self
    {
        $this->setConfig('stroke.dashArray', $dashArray);

        return $this;
    }

}