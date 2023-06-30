<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts;

use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;

abstract class CandlestickApexChart extends ApexChart
{

    public function initialize(): void
    {
        parent::initialize();
        $this->setChartType('candlestick');
        $this->setConfig('series', []);
    }

    /**
     * @param string|\Cake\I18n\FrozenTime|\Cake\I18n\FrozenDate $label
     * @param array $data
     */
    protected function appendData(string|FrozenTime|FrozenDate $label, array $data): void
    {
        if ($label instanceof FrozenTime) {
            $label = $label->timestamp * 1000;
            $label = self::wrapQuotesReplace("new Date($label)");
        }
        if ($label instanceof FrozenDate) {
            $label = $label->timestamp * 1000;
            $label = self::wrapQuotesReplace("new Date($label)");
        }
        $this->appendSerieData(0, [
            'x' => $label,
            'y' => $data,
        ]);
    }
}