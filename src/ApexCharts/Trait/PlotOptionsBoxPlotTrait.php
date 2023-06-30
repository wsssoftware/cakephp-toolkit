<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;

use Toolkit\Utilities\Colors;

trait PlotOptionsBoxPlotTrait
{

    /**
     * Color for the upper quartile (Q3 to median) of the box plot.
     *
     * @param string $upper
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBoxPlotTrait
     */
    public function setPlotOptionsBoxPlotColorsUpward(string $upper): self
    {
        Colors::validateColorOrFail($upper);
        $this->setConfig('plotOptions.boxPlot.colors.upper', $upper);

        return $this;
    }

    /**
     * Color for the lower quartile (median to Q1) of the box plot.
     *
     * @param string $lower
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBoxPlotTrait
     */
    public function setPlotOptionsBoxPlotColorsDownward(string $lower): self
    {
        Colors::validateColorOrFail($lower);
        $this->setConfig('plotOptions.boxPlot.colors.lower', $lower);

        return $this;
    }

}