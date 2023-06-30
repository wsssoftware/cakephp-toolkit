<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait ColorsTrait
{

    /**
     * @var array
     */
    protected array $_colors = [];

    /**
     * @return \Toolkit\ApexCharts\Trait\ColorsTrait|\Toolkit\ApexCharts\ApexChart
     */
    public function clearColors(): self
    {
        $this->_colors = [];

        return $this;
    }

    /**
     * @param string $color
     * @return \Toolkit\ApexCharts\Trait\ColorsTrait|\Toolkit\ApexCharts\ApexChart
     */
    public function setColor(string $color): self
    {
        if (in_array($color, $this->_colors)) {
            throw new ApexChartWrongOptionException('color');
        }
        Colors::validateColorOrFail($color);
        $this->_colors[] = $color;

        return $this;
    }

    /**
     * @param array $colors
     * @return \Toolkit\ApexCharts\Trait\ColorsTrait|\Toolkit\ApexCharts\ApexChart
     */
    public function setColors(array $colors): self
    {
        foreach ($colors as $color) {
            if (!is_string($color)) {
                throw new ApexChartWrongOptionException('setColors');
            }
            Colors::validateColorOrFail($color);
        }
        $this->_colors = $colors;

        return $this;
    }

    /**
     * @return void
     */
    protected function _setColorsOptions(): void
    {
        if (!empty($this->_colors)) {
            $this->setConfig('colors', $this->_colors);
        }
    }

}