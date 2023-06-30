<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait PlotOptionsBubbleTrait
{

    /**
     * Minimum radius size of a bubble. If a bubble value is too small to be displayed, this size will be used.
     *
     * @param int $minBubbleRadius
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBubbleTrait
     */
    public function setPlotOptionsBubbleMinBubbleRadius(int $minBubbleRadius): self
    {
        $this->setConfig('plotOptions.bubble.minBubbleRadius', $minBubbleRadius);

        return $this;
    }

    /**
     * Maximum radius size of a bubble. If a bubble value is too large to cover the chart, this size will be used.
     *
     * @param int $maxBubbleRadius
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsBubbleTrait
     */
    public function setPlotOptionsBubbleMaxBubbleRadius(int $maxBubbleRadius): self
    {
        $this->setConfig('plotOptions.bubble.maxBubbleRadius', $maxBubbleRadius);

        return $this;
    }

}