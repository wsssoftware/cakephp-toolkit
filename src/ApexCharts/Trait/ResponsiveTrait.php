<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;

trait ResponsiveTrait
{

    /**
     * @var array
     */
    protected array $_responsive = [];

    /**
     * @param string $breakpoint The breakpoint is the max screen width at which the original config object will be overrided by the responsive config object
     * @param array $options The new configuration object that you would like to override on the existing default configuration object. All the options which you set normally can be set here
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ResponsiveTrait
     */
    public function addResponsive(string $breakpoint, array $options): self
    {
        $this->_responsive[] = [
            'breakpoint'  => $breakpoint,
            'options' => $options
        ];

        return $this;
    }

    /**
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ResponsiveTrait
     */
    public function resetResponsive(): self
    {
        $this->_responsive = [];

        return $this;
    }

    /**
     * @return void
     */
    private function _setResponsive(): void
    {
        if (!empty($this->_responsive)) {
            $this->setConfig('responsive', $this->_responsive);
        }
    }

}