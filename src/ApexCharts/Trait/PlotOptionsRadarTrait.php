<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait PlotOptionsRadarTrait
{

    /**
     * A custom size for the inner radar. The default size calculation will be overrided with this
     *
     * @param int $size
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadarTrait
     */
    public function setPlotOptionsRadarSize(int $size): self
    {
        $this->setConfig('plotOptions.radar.size', $size);

        return $this;
    }

    /**
     * Sets the left offset of the radar
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadarTrait
     */
    public function setPlotOptionsRadarOffsetX(int $offsetX): self
    {
        $this->setConfig('plotOptions.radar.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset of the radar
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadarTrait
     */
    public function setPlotOptionsRadarOffsetY(int $offsetY): self
    {
        $this->setConfig('plotOptions.radar.offsetY', $offsetY);

        return $this;
    }

    /**
     * The line/border color of the spokes of the chart excluding the connector lines.
     * If you want to pass more than 1 color, you can pass an array instead of a String.
     * strokeColors: '#e8e8e8' and strokeColors: ['#e8e8e8', '#f1f1f1'] both are valid.
     *
     * @param string|array $strokeColors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadarTrait
     */
    public function setPlotOptionsRadarPolygonsStrokeColors(string|array $strokeColors): self
    {
        if (is_array($strokeColors)) {
            foreach ($strokeColors as $strokeColor) {
                Colors::validateColorOrFail($strokeColor);
            }
        } else {
            Colors::validateColorOrFail($strokeColors);
        }
        $this->setConfig('plotOptions.radar.polygons.strokeColors', $strokeColors);

        return $this;
    }

    /**
     * Border width of the spokes of radar chart.
     *
     * @param int $strokeWidth
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadarTrait
     */
    public function setPlotOptionsRadarPolygonsStrokeWidth(int $strokeWidth): self
    {
        $this->setConfig('plotOptions.radar.polygons.strokeWidth', $strokeWidth);

        return $this;
    }

    /**
     * The line color of the connector lines of the polygons. If you want to pass more than 1 color, you can pass an array instead of a String.
     * connectorColors: '#e8e8e8' and connectorColors: ['#e8e8e8', '#f1f1f1'] both are valid.
     *
     * @param string|array $connectorColors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadarTrait
     */
    public function setPlotOptionsRadarPolygonsConnectorColors(string|array $connectorColors): self
    {
        if (is_array($connectorColors)) {
            foreach ($connectorColors as $connectorColor) {
                Colors::validateColorOrFail($connectorColor);
            }
        } else {
            Colors::validateColorOrFail($connectorColors);
        }
        $this->setConfig('plotOptions.radar.polygons.connectorColors', $connectorColors);

        return $this;
    }

    /**
     * The polygons can be filled with a custom color. If you provide 2 colors, the colors will be repeated for the rest of the polygons.
     *
     * @param array $colors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsRadarTrait
     */
    public function setPlotOptionsRadarPolygonsFillColors(array $colors): self
    {
        foreach ($colors as $color) {
            Colors::validateColorOrFail($color);
        }
        $this->setConfig('plotOptions.radar.polygons.fill.colors', $colors);

        return $this;
    }

}