<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;

trait StatesTrait
{

    /**
     * The filter function to apply on normal state.
     * The available filter functions are:
     *  - none
     *  - lighten
     *  - darken
     *
     * @param string $type
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\StatesTrait
     */
    public function setStatesNormalFilterType(string $type): self
    {
        $valid = ['none', 'lighten', 'darken'];
        if (!in_array($type, $valid)) {
            throw new ApexChartWrongOptionException('states.normal.filter.type', $type, $valid);
        }
        $this->setConfig('states.normal.filter.type', $type);

        return $this;
    }

    /**
     * A larger value intensifies the filter effect Accepts values between 0 and 1
     *
     * @param float $value
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\StatesTrait
     */
    public function setStatesNormalFilterValue(float $value): self
    {
        $this->setConfig('states.normal.filter.value', $value);

        return $this;
    }

    /**
     * The filter function to apply on hover state.
     * The available filter functions are:
     *  - none
     *  - lighten
     *  - darken
     *
     * @param string $type
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\StatesTrait
     */
    public function setStatesHoverFilterType(string $type): self
    {
        $valid = ['none', 'lighten', 'darken'];
        if (!in_array($type, $valid)) {
            throw new ApexChartWrongOptionException('states.hover.filter.type', $type, $valid);
        }
        $this->setConfig('states.hover.filter.type', $type);

        return $this;
    }

    /**
     * A larger value intensifies the filter effect Accepts values between 0 and 1
     *
     * @param float $value
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\StatesTrait
     */
    public function setStatesHoverFilterValue(float $value): self
    {
        $this->setConfig('states.hover.filter.value', $value);

        return $this;
    }

    /**
     * The filter function to apply on active state.
     * The available filter functions are:
     *  - none
     *  - lighten
     *  - darken
     *
     * @param string $type
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\StatesTrait
     */
    public function setStatesActiveFilterType(string $type): self
    {
        $valid = ['none', 'lighten', 'darken'];
        if (!in_array($type, $valid)) {
            throw new ApexChartWrongOptionException('states.hover.filter.type', $type, $valid);
        }
        $this->setConfig('states.active.filter.type', $type);

        return $this;
    }


    /**
     * Whether to allow selection of multiple datapoints and give them active state or allow one dataPoint selection at a time.
     *
     * @param bool $allowMultipleDataPointsSelection
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\StatesTrait
     */
    public function setStatesActiveAllowMultipleDataPointsSelection(bool $allowMultipleDataPointsSelection): self
    {
        $this->setConfig('states.active.allowMultipleDataPointsSelection', $allowMultipleDataPointsSelection);

        return $this;
    }

    /**
     * A larger value intensifies the filter effect Accepts values between 0 and 1
     *
     * @param float $value
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\StatesTrait
     */
    public function setStatesActiveFilterValue(float $value): self
    {
        $this->setConfig('states.active.filter.value', $value);

        return $this;
    }


}