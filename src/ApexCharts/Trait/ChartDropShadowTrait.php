<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Cake\Error\FatalErrorException;
use Toolkit\Utilities\Colors;

trait ChartDropShadowTrait
{

    /**
     * Enable a dropshadow for paths of the SVG
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartDropShadowTrait
     */
    public function setChartDropShadowEnabled(bool $enabled): self
    {
        $this->setConfig('chart.dropShadow.enabled', $enabled);

        return $this;
    }

    /**
     * Provide series index on which the dropshadow should be enabled.
     *
     * @param array $enabledArray
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartDropShadowTrait
     */
    public function setChartDropShadowEnabledOnSeries(array $enabledArray): self
    {
        $this->setConfig('chart.dropShadow.enabledOnSeries', $enabledArray);

        return $this;
    }

    /**
     * Set top offset for shadow
     *
     * @param int $top
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartDropShadowTrait
     */
    public function setChartDropShadowTop(int $top): self
    {
        $this->setConfig('chart.dropShadow.top', $top);

        return $this;
    }

    /**
     * Set left offset for shadow
     *
     * @param int $left
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartDropShadowTrait
     */
    public function setChartDropShadowLeft(int $left): self
    {
        $this->setConfig('chart.dropShadow.left', $left);

        return $this;
    }

    /**
     * Set blur distance for shadow
     *
     * @param int $blur
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartDropShadowTrait
     */
    public function setChartDropShadowBlur(int $blur): self
    {
        $this->setConfig('chart.dropShadow.blur', $blur);

        return $this;
    }

    /**
     * Give a color to the shadow. If array is provided, each series can have different shadow color
     *
     * @param string|array $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartDropShadowTrait
     */
    public function setChartDropShadowColor(string|array $color): self
    {
        if (is_array($color)) {
            foreach ($color as $item) {
                if (!is_string($item)) {
                    throw new FatalErrorException('Color must to be a string');
                }
                Colors::validateColorOrFail($item);

            }
        } else {
            Colors::validateColorOrFail($color);
        }
        $this->setConfig('chart.dropShadow.color', $color);

        return $this;
    }

    /**
     * Set the opacity of shadow.
     *
     * @param float $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartDropShadowTrait
     */
    public function setChartDropShadowOpacity(float $opacity): self
    {
        $this->setConfig('chart.dropShadow.opacity', $opacity);

        return $this;
    }


}