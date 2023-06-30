<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts;


use Cake\Core\Configure;
use Cake\Core\InstanceConfigTrait;
use Cake\Datasource\ModelAwareTrait;
use Cake\Error\FatalErrorException;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\Utility\Hash;
use Toolkit\ApexCharts\Trait\AnnotationsTrait;
use Toolkit\ApexCharts\Trait\ChartAnimationsTrait;
use Toolkit\ApexCharts\Trait\ChartBrushTrait;
use Toolkit\ApexCharts\Trait\ChartDropShadowTrait;
use Toolkit\ApexCharts\Trait\ChartEventsTrait;
use Toolkit\ApexCharts\Trait\ChartSelectionTrait;
use Toolkit\ApexCharts\Trait\ChartToolbarTrait;
use Toolkit\ApexCharts\Trait\ChartTrait;
use Toolkit\ApexCharts\Trait\ChartZoomTrait;
use Toolkit\ApexCharts\Trait\ColorsTrait;
use Toolkit\ApexCharts\Trait\DataLabelsTrait;
use Toolkit\ApexCharts\Trait\FillTrait;
use Toolkit\ApexCharts\Trait\GridTrait;
use Toolkit\ApexCharts\Trait\LabelsTrait;
use Toolkit\ApexCharts\Trait\LegendTrait;
use Toolkit\ApexCharts\Trait\MarkersTrait;
use Toolkit\ApexCharts\Trait\NoDataTrait;
use Toolkit\ApexCharts\Trait\PlotOptionsAreaTrait;
use Toolkit\ApexCharts\Trait\PlotOptionsBarTrait;
use Toolkit\ApexCharts\Trait\PlotOptionsBoxPlotTrait;
use Toolkit\ApexCharts\Trait\PlotOptionsBubbleTrait;
use Toolkit\ApexCharts\Trait\PlotOptionsCandlestickTrait;
use Toolkit\ApexCharts\Trait\PlotOptionsHeatmapTrait;
use Toolkit\ApexCharts\Trait\PlotOptionsPieTrait;
use Toolkit\ApexCharts\Trait\PlotOptionsPolarAreaTrait;
use Toolkit\ApexCharts\Trait\PlotOptionsRadarTrait;
use Toolkit\ApexCharts\Trait\PlotOptionsRadialBarTrait;
use Toolkit\ApexCharts\Trait\PlotOptionsTreemapTrait;
use Toolkit\ApexCharts\Trait\ResponsiveTrait;
use Toolkit\ApexCharts\Trait\SeriesTrait;
use Toolkit\ApexCharts\Trait\StatesTrait;
use Toolkit\ApexCharts\Trait\StrokeTrait;
use Toolkit\ApexCharts\Trait\SubtitleTrait;
use Toolkit\ApexCharts\Trait\ThemeTrait;
use Toolkit\ApexCharts\Trait\TitleTrait;
use Toolkit\ApexCharts\Trait\TooltipTrait;
use Toolkit\ApexCharts\Trait\XaxisTrait;
use Toolkit\ApexCharts\Trait\YaxisTrait;
use Toolkit\Utilities\Arrays;

abstract class SeriesApexChart extends ApexChart
{

    /**
     * @param string|\Cake\I18n\FrozenTime|\Cake\I18n\FrozenDate $label
     * @param mixed ...$series
     */
    protected function appendData(string|FrozenTime|FrozenDate $label, array|int|float ...$series): void
    {
        if ($label instanceof FrozenTime) {
            $label = $label->format('Y-m-d H:i');
        }
        if ($label instanceof FrozenDate) {
            $label = $label->format('Y-m-d');
        }
        $this->addLabel($label);
        foreach ($series as $index => $serie) {
            $this->appendSerieData($index, $serie);
        }
    }
}