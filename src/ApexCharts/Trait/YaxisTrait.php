<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\ApexCharts\Entity\Yaxis;

trait YaxisTrait
{

    /**
     * @var \Toolkit\ApexCharts\Entity\Yaxis[]
     */
    protected array $_yaxis = [];

    /**
     * @return \Toolkit\ApexCharts\Entity\Yaxis
     */
    public function addYaxis(): Yaxis
    {
        $yaxis = new Yaxis($this);
        $this->_yaxis[] = $yaxis;

        return $yaxis;
    }


    /**
     * @return \Toolkit\ApexCharts\Trait\YaxisTrait|\Toolkit\ApexCharts\ApexChart
     */
    public function clearYaxis(): self
    {
        $this->_yaxis = [];

        return $this;
    }

    /**
     * @param int $index
     * @return \Toolkit\ApexCharts\Entity\Yaxis|null
     */
    public function getYaxis(int $index): Yaxis|null
    {
        if (empty($this->_yaxis[$index])) {
            return null;
        }

        return $this->_yaxis[$index];
    }

    /**
     * @param int $index
     * @return \Toolkit\ApexCharts\Entity\Yaxis[]
     */
    public function getAllYaxis(int $index): array
    {
        return $this->_yaxis;
    }

    /**
     * @return void
     */
    protected function _setYaxis(): void
    {
        if (!empty($this->_yaxis)) {
            $yaxis = [];
            foreach ($this->_yaxis as $item) {
                if (!empty($item->getConfig())) {
                    $yaxis[] = $item->getConfig();
                }
            }
            if (count($yaxis) === 1) {
                $this->setConfig('yaxis', $yaxis[array_key_first($yaxis)]);
            } else {
                $this->setConfig('yaxis', $yaxis);
            }
        }
    }

}