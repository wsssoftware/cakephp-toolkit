<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait LegendTrait
{

    /**
     * Whether to show or hide the legend container.
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendEnabled(bool $enabled): self
    {
        $this->setConfig('legend.enabled', $enabled);

        return $this;
    }

    /**
     * Show legend even if there is just 1 series.
     *
     * @param bool $showForSingleSeries
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendShowForSingleSeries(bool $showForSingleSeries): self
    {
        $this->setConfig('legend.showForSingleSeries', $showForSingleSeries);

        return $this;
    }

    /**
     * Allows you to hide a particular legend if it’s series contains all null values.
     *
     * @param bool $showForNullSeries
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendShowForNullSeries(bool $showForNullSeries): self
    {
        $this->setConfig('legend.showForNullSeries', $showForNullSeries);

        return $this;
    }

    /**
     * Allows you to hide a particular legend if it’s series contains all 0 values.
     *
     * @param bool $showForZeroSeries
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendShowForZeroSeries(bool $showForZeroSeries): self
    {
        $this->setConfig('legend.showForZeroSeries', $showForZeroSeries);

        return $this;
    }

    /**
     * Available position options for legend:
     *  - top
     *  - right
     *  - bottom
     *  - left
     *
     * @param string $position
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendPosition(string $position): self
    {
        $valid = ['top', 'right', 'bottom', 'left'];
        if (!in_array($position, $valid)) {
            throw new ApexChartWrongOptionException('legend.position', $position, $valid);
        }
        $this->setConfig('legend.position', $position);

        return $this;
    }

    /**
     * Available options for horizontal alignment:
     *  - left
     *  - center
     *  - right
     *
     * @param string $horizontalAlign
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendHorizontalAlign(string $horizontalAlign): self
    {
        $valid = ['left', 'center', 'right'];
        if (!in_array($horizontalAlign, $valid)) {
            throw new ApexChartWrongOptionException('legend.horizontalAlign', $horizontalAlign, $valid);
        }
        $this->setConfig('legend.horizontalAlign', $horizontalAlign);

        return $this;
    }

    /**
     * The floating option will take out the legend from the chart area and make it float above the chart.
     *
     * @param bool $floating
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendFloating(bool $floating): self
    {
        $this->setConfig('legend.floating', $floating);

        return $this;
    }

    /**
     * Sets the fontSize of legend text elements
     *
     * @param string $fontSize
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendFontSize(string $fontSize): self
    {
        $this->setConfig('legend.fontSize', $fontSize);

        return $this;
    }

    /**
     * Sets the font-family of legend text elements
     *
     * @param string $fontFamily
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendFontFamily(string $fontFamily): self
    {
        $this->setConfig('legend.fontFamily', $fontFamily);

        return $this;
    }

    /**
     * Sets the font-weight of legend text elements
     *
     * @param string|int $fontWeight
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendFontWeight(string|int $fontWeight): self
    {
        $this->setConfig('legend.fontWeight', $fontWeight);

        return $this;
    }

    /**
     * A custom formatter function to append additional text to the legend series names
     *
     * @note available parameters 'seriesName', 'opts'
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendFormatter(string $functionBody): self
    {
        $this->setConfig('legend.formatter', $this->_buildJsFunction($functionBody, ['seriesName', 'opts']));

        return $this;
    }

    /**
     * Inverse the placement ordering of the legend items.
     *
     * @param bool $inverseOrder
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendInverseOrder(bool $inverseOrder): self
    {
        $this->setConfig('legend.inverseOrder', $inverseOrder);

        return $this;
    }

    /**
     * Sets the width for legend container
     *
     * @param int $width
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendWidth(int $width): self
    {
        $this->setConfig('legend.width', $width);

        return $this;
    }

    /**
     * Sets the height for legend container
     *
     * @param int $height
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendHeight(int $height): self
    {
        $this->setConfig('legend.height', $height);

        return $this;
    }

    /**
     * A formatter function to allow showing data values in the legend while hovering on the chart.
     * This can be useful when you have multiple series, and you don’t want to show tooltips for each series together.
     *
     * @note available parameters 'seriesName', 'opts'
     * @note  This feature is only available in shared tooltips (when you have tooltip.shared: true).
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendTooltipHoverFormatter(string $functionBody): self
    {
        $this->setConfig('legend.tooltipHoverFormatter', $this->_buildJsFunction($functionBody, ['seriesName', 'opts']));

        return $this;
    }

    /**
     * Allows you to overwrite the default legend items with this customized set of labels.
     * Please note that the click/hover events of the legend will stop working if you provide these custom legend labels.
     *
     * @param array $customLegendItems
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendCustomLegendItems(array $customLegendItems): self
    {
        $this->setConfig('legend.customLegendItems', $customLegendItems);

        return $this;
    }

    /**
     * Custom text colors for legend labels. Accepts an array of colors where each index corresponds to the series index
     *
     * @param array $colors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendLabelsColors(array $colors): self
    {
        foreach ($colors as $color) {
            Colors::validateColorOrFail($color);
        }
        $this->setConfig('legend.labels.colors', $colors);

        return $this;
    }

    /**
     * Whether to use primary colors or not.
     *
     * @param bool $useSeriesColors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendLabelsUseSeriesColors(bool $useSeriesColors): self
    {
        $this->setConfig('legend.labels.useSeriesColors', $useSeriesColors);

        return $this;
    }

    /**
     * Width of the marker that appears before series name.
     *
     * @param int $width
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendMarkersWidth(int $width): self
    {
        $this->setConfig('legend.markers.width', $width);

        return $this;
    }

    /**
     * Height of the marker.
     *
     * @param int $height
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendMarkersHeight(int $height): self
    {
        $this->setConfig('legend.markers.height', $height);

        return $this;
    }

    /**
     * Stroke Size of the marker point.
     *
     * @param int $strokeWidth
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendMarkersStrokeWidth(int $strokeWidth): self
    {
        $this->setConfig('legend.markers.strokeWidth', $strokeWidth);

        return $this;
    }

    /**
     * Stroke Color of the marker point.
     *
     * @param string $strokeColor
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendMarkersStrokeColor(string $strokeColor): self
    {
        Colors::validateColorOrFail($strokeColor);
        $this->setConfig('legend.markers.strokeColor', $strokeColor);

        return $this;
    }

    /**
     * Fill Colors of the marker point.
     *
     * @param array $fillColors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendMarkersFillColors(array $fillColors): self
    {
        foreach ($fillColors as $fillColor) {
            Colors::validateColorOrFail($fillColor);
        }
        $this->setConfig('legend.labels.fillColors', $fillColors);

        return $this;
    }

    /**
     * Border Radius of the marker
     *
     * @param int $radius
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendMarkersRadius(int $radius): self
    {
        $this->setConfig('legend.markers.radius', $radius);

        return $this;
    }

    /**
     * Custom HTML element to put in place of marker
     *
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendMarkersCustomHTML(string $functionBody): self
    {
        $this->setConfig('legend.markers.customHTML', $this->_buildJsFunction($functionBody, []));

        return $this;
    }

    /**
     * Fire an event when legend’s marker is clicked
     *
     * @note Available parameters are 'chart', 'seriesIndex', 'opts'
     * @param string $functionBody
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendMarkersOnClick(string $functionBody): self
    {
        $this->setConfig('legend.markers.onClick', $this->_buildJsFunction($functionBody, ['chart', 'seriesIndex', 'opts']));

        return $this;
    }

    /**
     * Sets the left offset of the marker
     *
     * @param int $offsetX
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendMarkersOffsetX(int $offsetX): self
    {
        $this->setConfig('legend.markers.offsetX', $offsetX);

        return $this;
    }

    /**
     * Sets the top offset of the marker
     *
     * @param int $offsetY
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendMarkersOffsetY(int $offsetY): self
    {
        $this->setConfig('legend.markers.offsetY', $offsetY);

        return $this;
    }

    /**
     * Horizontal margin for individual legend item.
     *
     * @param int $horizontal
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendItemMarginHorizontal(int $horizontal): self
    {
        $this->setConfig('legend.itemMargin.horizontal', $horizontal);

        return $this;
    }

    /**
     * Vertical margin for individual legend item.
     *
     * @param int $vertical
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendItemMarginVertical(int $vertical): self
    {
        $this->setConfig('legend.itemMargin.vertical', $vertical);

        return $this;
    }

    /**
     * When clicked on legend item, it will toggle the visibility of the series in chart.
     *
     * @param bool $toggleDataSeries
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendOnItemClickToggleDataSeries(bool $toggleDataSeries): self
    {
        $this->setConfig('legend.onItemClick.toggleDataSeries', $toggleDataSeries);

        return $this;
    }

    /**
     * When hovered on legend item, it will highlight the paths of the hovered series in chart.
     *
     * @param bool $highlightDataSeries
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\LegendTrait
     */
    public function setLegendOnItemHoverHighlightDataSeries(bool $highlightDataSeries): self
    {
        $this->setConfig('legend.onItemHover.highlightDataSeries', $highlightDataSeries);

        return $this;
    }

}