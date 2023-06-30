<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait PlotOptionsPolarAreaTrait
{

    /**
     * Border width of the rings of polarArea chart.
     *
     * @param int $strokeWidth
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPolarAreaTrait
     */
    public function setPlotOptionsPolarAreaPolygonsStrokeWidth(int $strokeWidth): self
    {
        $this->setConfig('plotOptions.polarArea.polygons.strokeWidth', $strokeWidth);

        return $this;
    }

    /**
     * The line/border color of the rings of the chart.
     *
     * @param string $strokeColor
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPolarAreaTrait
     */
    public function setPlotOptionsPolarAreaPolygonsStrokeColor(string $strokeColor): self
    {
        Colors::validateColorOrFail($strokeColor);
        $this->setConfig('plotOptions.polarArea.polygons.strokeColor', $strokeColor);

        return $this;
    }

    /**
     * Border width of the spokes of polarArea chart.
     *
     * @param int $strokeWidth
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPolarAreaTrait
     */
    public function setPlotOptionsPolarAreaSpokesStrokeWidth(int $strokeWidth): self
    {
        $this->setConfig('plotOptions.polarArea.spokes.strokeWidth', $strokeWidth);

        return $this;
    }

    /**
     * The line/border color of the spokes of polarArea chart.
     *
     * @param string|array $connectorColors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsPolarAreaTrait
     */
    public function setPlotOptionsPolarAreaSpokesStrokeConnectorColors(string|array $connectorColors): self
    {
        if (is_array($connectorColors)) {
            foreach ($connectorColors as $connectorColor) {
                Colors::validateColorOrFail($connectorColor);
            }
        } else {
            Colors::validateColorOrFail($connectorColors);
        }
        $this->setConfig('plotOptions.polarArea.spokes.connectorColors', $connectorColors);

        return $this;
    }


}