<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;

use Toolkit\Exception\ApexChartWrongOptionException;

trait ChartAnimationsTrait
{

    /**
     * Enable or disable all the animations that happen initially or during data update.
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartAnimationsTrait
     */
    public function setChartAnimationsEnabled(bool $enabled): self
    {
        $this->setConfig('chart.animations.enabled', $enabled);

        return $this;
    }

    /**
     * Available easing options:
     *  - linear
     *  - easein
     *  - easeout
     *  - easeinout
     *
     * @param string $easing
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartAnimationsTrait
     */
    public function setChartAnimationsEasing(string $easing): self
    {
        $valid = ['linear', 'easein', 'easeout', 'easeinout'];
        if (!in_array($easing, $valid)) {
            throw new ApexChartWrongOptionException('chart.animations.easing', $easing, $valid);
        }
        $this->setConfig('chart.animations.easing', $easing);

        return $this;
    }

    /**
     * Speed at which animation runs.
     *
     * @param int $speed
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartAnimationsTrait
     */
    public function setChartAnimationsSpeed(int $speed): self
    {
        $this->setConfig('chart.animations.speed', $speed);

        return $this;
    }

    /**
     * Gradually animate one by one every data in the series instead of animating all at once.
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartAnimationsTrait
     */
    public function setChartAnimationsAnimateGraduallyEnabled(bool $enabled): self
    {
        $this->setConfig('chart.animations.animateGradually.enabled', $enabled);

        return $this;
    }

    /**
     * Speed at which gradual (one by one) animation runs.
     *
     * @param int $delay
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartAnimationsTrait
     */
    public function setChartAnimationsAnimateGraduallyDelay(int $delay): self
    {
        $this->setConfig('chart.animations.animateGradually.delay', $delay);

        return $this;
    }

    /**
     * Animate the chart when data is changed and chart is re-rendered.
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartAnimationsTrait
     */
    public function setChartAnimationsDynamicAnimationEnabled(bool $enabled): self
    {
        $this->setConfig('chart.animations.dynamicAnimation.enabled', $enabled);

        return $this;
    }

    /**
     * Speed at which dynamic animation runs whenever data changes.
     *
     * @param int $speed
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartAnimationsTrait
     */
    public function setChartAnimationsDynamicAnimationDelay(int $speed): self
    {
        $this->setConfig('chart.animations.dynamicAnimation.speed', $speed);

        return $this;
    }

}