<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;

trait LabelsTrait
{

    /**
     * @var array
     */
    protected array $_labels = [];

    /**
     * In Axis Charts (line / column), labels can be set instead of setting xaxis categories option.
     * While, in pie/donut charts, each label corresponds to value in series array.
     *
     * @param array $labels
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LabelsTrait
     */
    public function setLabels(array $labels): self
    {
        $this->resetLabels();
        foreach ($labels as $label) {
            $this->addLabel($label);
        }

        return $this;
    }

    /**
     * @param string $label
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LabelsTrait
     */
    public function addLabel(string $label): self
    {
        $this->_labels[] = $label;

        return $this;
    }

    /**
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartToolbarTrait
     */
    public function resetLabels(): self
    {
        $this->_labels = [];

        return $this;
    }

    /**
     * @return void
     */
    private function _setLabels(): void
    {
        if (!empty($this->_labels)) {
            $this->setConfig('labels', $this->_labels);
        }
    }

}