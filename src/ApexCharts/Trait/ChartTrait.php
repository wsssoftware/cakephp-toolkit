<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;

use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait ChartTrait
{

    /**
     * Background color for the chart area. If you want to set background with css, use .apexcharts-canvas to set it.
     *
     * @param string $background
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartBackground(string $background): self
    {
        Colors::validateColorOrFail($background);
        $this->setConfig('chart.background', $background);

        return $this;
    }

    /**
     * Sets the font family for all the text elements of the chart. Defaults to 'Helvetica, Arial, sans-serif'
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartFontFamily(string $fontFamily): self
    {
        $this->setConfig('chart.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * Sets the text color for the chart. Defaults to #373d3f
     *
     * @param string $foreColor
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartForeColor(string $foreColor): self
    {
        Colors::validateColorOrFail($foreColor);
        $this->setConfig('chart.foreColor', $foreColor);

        return $this;
    }

    /**
     * A chart group is created to perform interactive operations at the same time in all the charts.
     * In case you want to create synchronized charts, you will need to provide this property.
     *
     * @param string $group
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartGroup(string $group): self
    {
        $this->setConfig('chart.group', $group);

        return $this;
    }

    /**
     * Height of the chart. The default value ‘auto’ is calculated based on the golden ratio 1.618 which roughly translates to a 16:10 aspect ratio.
     * Below all are valid values for the height property
     *
     * @note If you provide a percentage value '100%', make sure to have a fixed height parent.
     * @param int|string $height
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartHeight(int|string $height): self
    {
        $this->setConfig('chart.height', $height);

        return $this;
    }

    /**
     * A chart ID is a unique identifier that will be used in calling certain ApexCharts methods.
     * You will also need chart.id to be set in case you want to use any of the following functionalities.
     *  - brush chart
     *  - synchronized chart
     *  - Calling exec method of ApexCharts
     *
     * @param string $id
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartId(string $id): self
    {
        $this->setConfig('chart.id', $id);

        return $this;
    }

    /**
     * Sets the left offset for the whole chart.
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartOffsetX(int $offsetX): self
    {
        $this->setConfig('chart.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset for the entire chart.
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartOffsetY(int $offsetY): self
    {
        $this->setConfig('chart.offsetY', $offsetY);

        return $this;
    }

    /**
     * A small increment in height added to the parent of chart element.
     *
     * @param int $parentHeightOffset
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartParentHeightOffset(int $parentHeightOffset): self
    {
        $this->setConfig('chart.parentHeightOffset', $parentHeightOffset);

        return $this;
    }

    /**
     * Re-render the chart when the element size gets changed or the size of the parent element gets changed.
     * Useful in conditions where the chart container resizes after page reload.
     *
     * @param bool $redrawOnParentResize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartRedrawOnParentResize(bool $redrawOnParentResize): self
    {
        $this->setConfig('chart.redrawOnParentResize', $redrawOnParentResize);

        return $this;
    }

    /**
     * Re-render the chart when the window in which chart is rendered gets resized. Useful when rendering chart in iframes.
     *
     * @param bool $redrawOnWindowResize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartRedrawOnWindowResize(bool $redrawOnWindowResize): self
    {
        $this->setConfig('chart.redrawOnWindowResize', $redrawOnWindowResize);

        return $this;
    }

    /**
     * Sparkline hides all the elements of the charts other than the primary paths. Helps to visualize data in small areas
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartSparklineEnabled(bool $enabled): self
    {
        $this->setConfig('chart.sparkline.enabled', $enabled);

        return $this;
    }

    /**
     * Enables stacked option for axis charts.
     *
     * @note A stacked chart works only for same chart types and won’t work in combo/mixed charts combinations.So, an area series combined with a column series will not work.
     * @param bool $stacked
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartStacked(bool $stacked): self
    {
        $this->setConfig('chart.stacked', $stacked);

        return $this;
    }

    /**
     * When stacked, should the stacking be percentage based or normal stacking.
     * Available Options:
     *  - normal
     *  - 100%
     *
     * @param string $stackType
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartStackType(string $stackType): self
    {
        $valid = ['normal', '100%'];
        if (!in_array($stackType, $valid)) {
            throw new ApexChartWrongOptionException('chart.stackType', $stackType, $valid);
        }
        $this->setConfig('chart.stackType', $stackType);

        return $this;
    }

    /**
     * Specify the chart type
     * Available Options:
     *  - line
     *  - area
     *  - bar
     *  - radar
     *  - histogram
     *  - pie
     *  - donut
     *  - radialBar
     *  - scatter
     *  - bubble
     *  - heatmap
     *  - candlestick
     *
     * @param string $type
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartType(string $type): self
    {
        $valid = ['line', 'area', 'bar', 'radar', 'histogram', 'pie', 'donut', 'radialBar', 'scatter', 'bubble', 'heatmap', 'candlestick'];
        if (!in_array($type, $valid)) {
            throw new ApexChartWrongOptionException('chart.type', $type, $valid);
        }
        $this->setConfig('chart.type', $type);

        return $this;
    }

    /**
     * Width of the chart.
     *
     * @param int|string $width
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\ChartTrait
     */
    public function setChartWidth(int|string $width): self
    {
        $this->setConfig('chart.width', $width);

        return $this;
    }

    /**
     * @return void
     */
    private function _setLocales(): void
    {
        $this->setConfig('chart.defaultLocale', 'default');
        $this->setConfig('chart.locales', [
            [
                'name' => "default",
                'options' => [
                    'months' => [
                        __d('toolkit', 'Janeiro'),
                        __d('toolkit', 'Fevereiro'),
                        __d('toolkit', 'Março'),
                        __d('toolkit', 'Abril'),
                        __d('toolkit', 'Maio'),
                        __d('toolkit', 'Junho'),
                        __d('toolkit', 'Julho'),
                        __d('toolkit', 'Agosto'),
                        __d('toolkit', 'Setembro'),
                        __d('toolkit', 'Outubro'),
                        __d('toolkit', 'Novembro'),
                        __d('toolkit', 'Dezembro')
                    ],
                    'shortMonths' => [
                        __d('toolkit', 'Jan'),
                        __d('toolkit', 'Fev'),
                        __d('toolkit', 'Mar'),
                        __d('toolkit', 'Abr'),
                        __d('toolkit', 'Mai'),
                        __d('toolkit', 'Jun'),
                        __d('toolkit', 'Jul'),
                        __d('toolkit', 'Ago'),
                        __d('toolkit', 'Set'),
                        __d('toolkit', 'Out'),
                        __d('toolkit', 'Nov'),
                        __d('toolkit', 'Dez')
                    ],
                    'days' => [__d('toolkit', 'Domingo'), __d('toolkit', 'Segunda'), __d('toolkit', 'Terça'), __d('toolkit', 'Quarta'), __d('toolkit', 'Quinta'), __d('toolkit', 'Sexta'), __d('toolkit', 'Sábado')],
                    'shortDays' => [__d('toolkit', 'Dom'), __d('toolkit', 'Seg'), __d('toolkit', 'Ter'), __d('toolkit', 'Qua'), __d('toolkit', 'Qui'), __d('toolkit', 'Sex'), __d('toolkit', 'Sab')],
                    'toolbar' => [
                        'exportToSVG' => __d('toolkit', 'Baixar SVG'),
                        'exportToPNG' => __d('toolkit', 'Baixar PNG'),
                        'exportToCSV' => __d('toolkit', 'Baixar CSV'),
                        'menu' => __d('toolkit', 'Menu'),
                        'selection' => __d('toolkit', 'Selecionar'),
                        'selectionZoom' => __d('toolkit', 'Selecionar Zoom'),
                        'zoomIn' => __d('toolkit', 'Aumentar'),
                        'zoomOut' => __d('toolkit', 'Diminuir'),
                        'pan' => __d('toolkit', 'Navegação'),
                        'reset' => __d('toolkit', 'Reiniciar Zoom'),
                    ]
                ]
            ]
        ]);
    }

}