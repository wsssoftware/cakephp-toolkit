<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait PlotOptionsCandlestickTrait
{

    /**
     * Color for the upward candle when the value/price closed above where it opened. Usually, a green color is used for this upward candle.
     *
     * @param string $upward
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsCandlestickTrait
     */
    public function setPlotOptionsCandlestickColorsUpward(string $upward): self
    {
        Colors::validateColorOrFail($upward);
        $this->setConfig('plotOptions.candlestick.colors.upward', $upward);

        return $this;
    }

    /**
     * Color for the downward candle when the value/price closed below where it opened. Usually, a red color is used for this downward candle.
     *
     * @param string $downward
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsCandlestickTrait
     */
    public function setPlotOptionsCandlestickColorsDownward(string $downward): self
    {
        Colors::validateColorOrFail($downward);
        $this->setConfig('plotOptions.candlestick.colors.downward', $downward);

        return $this;
    }

    /**
     * Use the same fill color for the wick. If this is false, the color of the wick falls back to the stroke.
     *
     * @param bool $useFillColor
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\PlotOptionsCandlestickTrait
     */
    public function setPlotOptionsCandlestickWickDownward(bool $useFillColor): self
    {
        $this->setConfig('plotOptions.candlestick.wick.useFillColor', $useFillColor);

        return $this;
    }

}