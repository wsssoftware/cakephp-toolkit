<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Cake\Error\FatalErrorException;
use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait MarkersTrait
{

    /**
     * @var array
     */
    protected array $_markersDiscrete = [];

    /**
     * Size of the marker point.
     * In a multi-series chart, you can provide an array of numbers to display different size of markers on different series
     *
     * @param int|array $size
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersSize(int|array $size): self
    {
        if (is_array($size)) {
            foreach ($size as $item) {
                if (!is_integer($item)) {
                    throw new FatalErrorException('Size item on array must to be integer');
                }
            }
        }
        $this->setConfig('markers.size', $size);

        return $this;
    }

    /**
     * Sets the fill color(s) of the marker point.
     *
     * @param array colors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersColors(array $colors): self
    {
        foreach ($colors as $color) {
            Colors::validateColorOrFail($color);
        }
        $this->setConfig('markers.colors', $colors);

        return $this;
    }

    /**
     * Stroke Color of the marker. Accepts a single color or an array of colors in a multi-series chart.
     *
     * @param array|string $strokeColors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersStrokeColors(array|string $strokeColors): self
    {
        if (is_array($strokeColors)) {
            foreach ($strokeColors as $strokeColor) {
                Colors::validateColorOrFail($strokeColor);
            }
        } else {
            Colors::validateColorOrFail($strokeColors);
        }
        $this->setConfig('markers.strokeColors', $strokeColors);

        return $this;
    }

    /**
     * Stroke Size of the marker.
     *
     * @param int|array $strokeWidth
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersStrokeWidth(int|array $strokeWidth): self
    {
        if (is_array($strokeWidth)) {
            foreach ($strokeWidth as $item) {
                if (!is_integer($item)) {
                    throw new FatalErrorException('Stroke width item on array must to be integer');
                }
            }
        }
        $this->setConfig('markers.strokeWidth', $strokeWidth);

        return $this;
    }

    /**
     * Opacity of the border around marker.
     *
     * @param array|float $strokeOpacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersStrokeOpacity(array|float $strokeOpacity): self
    {
        if (is_array($strokeOpacity)) {
            foreach ($strokeOpacity as $item) {
                if (!is_float($item) || is_integer($item)) {
                    throw new FatalErrorException('Stroke opacity item on array must to be float');
                }
            }
        }
        $this->setConfig('markers.strokeOpacity', $strokeOpacity);

        return $this;
    }

    /**
     * Dashes in the border around marker. Higher number creates more space between dashes in the border.
     *
     * @param int|array $strokeDashArray
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersStrokeDashArray(int|array $strokeDashArray): self
    {
        if (is_array($strokeDashArray)) {
            foreach ($strokeDashArray as $item) {
                if (!is_float($item) || is_integer($item)) {
                    throw new FatalErrorException('Stroke dash array item on array must to be integer');
                }
            }
        }
        $this->setConfig('markers.strokeDashArray', $strokeDashArray);

        return $this;
    }

    /**
     * Opacity of the marker fill color.
     *
     * @param array|float $fillOpacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersFillOpacity(array|float $fillOpacity): self
    {
        if (is_array($fillOpacity)) {
            foreach ($fillOpacity as $item) {
                if (!is_float($item) || is_integer($item)) {
                    throw new FatalErrorException('Stroke opacity item on array must to be float');
                }
            }
        }
        $this->setConfig('markers.fillOpacity', $fillOpacity);

        return $this;
    }

    /**
     * Allows you to target individual data-points and style particular marker differently
     *
     * @param int $seriesIndex
     * @param int $dataPointIndex
     * @param string $fillColor
     * @param string $strokeColor
     * @param int $size
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function addMarkersDiscrete(int $seriesIndex, int $dataPointIndex, string $fillColor, string $strokeColor, int $size): self
    {
        Colors::validateColorOrFail($fillColor);
        Colors::validateColorOrFail($strokeColor);
        $discrete = [
            'seriesIndex' => $seriesIndex,
            'dataPointIndex' => $dataPointIndex,
            'fillColor' => $fillColor,
            'strokeColor' => $strokeColor,
            'size' => $size
        ];

        $this->_markersDiscrete[] = $discrete;

        return $this;
    }

    /**
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function resetMarkersDiscrete(): self
    {
        $this->_markersDiscrete = [];

        return $this;
    }

    /**
     * @return void
     */
    private function _setMarkersDiscrete(): void
    {
        if (!empty($this->_markersDiscrete)) {
            $this->setConfig('markers.discrete', $this->_markersDiscrete);
        }
    }

    /**
     * Radius of the marker (applies to square shape)
     *
     * @param int $radius
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersRadius(int $radius): self
    {
        $this->setConfig('markers.radius', $radius);

        return $this;
    }

    /**
     * Shape of the marker.
     * Available Options for shape:
     *  - circle
     *  - square
     *
     * @param string $shape
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersShape(string $shape): self
    {
        $valid = ['circle', 'square'];
        if (!in_array($shape, $valid)) {
            throw new ApexChartWrongOptionException('markers.shape', $shape, $valid);
        }
        $this->setConfig('markers.shape', $shape);

        return $this;
    }

    /**
     * Sets the left offset of the marker
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersOffsetX(int $offsetX): self
    {
        $this->setConfig('markers.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset of the marker
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersOffsetY(int $offsetY): self
    {
        $this->setConfig('markers.offsetY', $offsetY);

        return $this;
    }

    /**
     * When a marker is clicked, markers.onClick is called.
     *
     * @note available parameters are 'e'
     * @note This event will not work for a shared and non-intersecting tooltip. You will have to modify your tooltip to the following code to catch the events.
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersOnClick(string $functionBody): self
    {
        $this->setConfig('markers.onClick', $this->_buildJsFunction($functionBody, ['e']));

        return $this;
    }

    /**
     * When a marker is double clicked, markers.onDblClick is called.
     *
     * @note available parameters are 'e'
     * @note This event will not work for a shared and non-intersecting tooltip. You will have to modify your tooltip to the following code to catch the events.
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersOnDblClick(string $functionBody): self
    {
        $this->setConfig('markers.onDblClick', $this->_buildJsFunction($functionBody, ['e']));

        return $this;
    }

    /**
     * Whether to show markers for null values in a line/area chart. If disabled, any null values present in line/area charts will not be visible.
     *
     * @param bool $showNullDataPoints
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersShowNullDataPoints(bool $showNullDataPoints): self
    {
        $this->setConfig('markers.showNullDataPoints', $showNullDataPoints);

        return $this;
    }

    /**
     * Fixed size of the marker when it is active
     *
     * @param int $size
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersHoverSize(int $size): self
    {
        $this->setConfig('markers.hover.size', $size);

        return $this;
    }

    /**
     * Unlike the fixed size, this option takes the original markers.size and increases/decreases the value based on it.
     * So, if markers.size: 6, markers.hover.sizeOffset: 3 will make the marker’s size 9 when hovered.
     *
     * @param int $sizeOffset
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\MarkersTrait
     */
    public function setMarkersHoverSizeOffset(int $sizeOffset): self
    {
        $this->setConfig('markers.hover.sizeOffset', $sizeOffset);

        return $this;
    }

}