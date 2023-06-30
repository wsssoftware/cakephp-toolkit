<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;

trait SeriesTrait
{

    /**
     * @var array
     */
    protected array $_series = [];

    /**
     * @var bool
     */
    protected bool $_renderSeriesEmpty = false;

    /**
     * @param string $name
     * @param string|null $type
     * @param array $data
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SeriesTrait
     */
    public function addSerie(string $name, string $type = null, array $data = []): self
    {
        $serie = [
            'name' => $name,
            'data' => $data,
        ];
        if (!empty($type)) {
            $serie['type'] = $type;
        }
        $this->_series[] = $serie;

        return $this;
    }

    /**
     * @param int|float $value
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SeriesTrait
     */
    public function addSerieNumeric(int|float $value): self
    {
        $this->_series[] = $value;

        return $this;
    }

    /**
     * @param int $index
     * @param float|int|array $data
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SeriesTrait
     */
    public function appendSerieData(int $index, float|int|array $data): self
    {
        if (!is_array($data)) {
            $data = [$data];
        }
        if (is_array($data) && !empty($data['x']) && !empty($data['y'])) {
            if (empty($this->_series)) {
                $this->_series[]['data'][] = $data;
            } else {
                $this->_series[array_key_first($this->_series)]['data'][] = $data;
            }

        } else {
            foreach ($data as $datum) {
                $this->_series[$index]['data'][] = $datum;
            }
        }

        return $this;
    }

    /**
     * @param bool $renderSeriesEmpty
     */
    public function setRenderSeriesEmpty(bool $renderSeriesEmpty): void
    {
        $this->_renderSeriesEmpty = $renderSeriesEmpty;
    }

    /**
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SeriesTrait
     */
    public function resetSeries(): self
    {
        $this->_series = [];

        return $this;
    }

    /**
     * @return void
     */
    private function _setSeries(): void
    {
        if (!empty($this->_series) || $this->_renderSeriesEmpty === true) {
            $this->setConfig('series', $this->_series);
        }
    }

}