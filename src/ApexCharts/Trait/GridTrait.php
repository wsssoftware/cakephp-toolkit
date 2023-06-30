<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Cake\Error\FatalErrorException;
use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait GridTrait
{

    /**
     * To show or hide grid area (including xaxis / yaxis)
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridShow(bool $show): self
    {
        $this->setConfig('grid.show', $show);

        return $this;
    }

    /**
     * Colors of grid borders / lines
     *
     * @param string $borderColor
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridBorderColor(string $borderColor): self
    {
        Colors::validateColorOrFail($borderColor);
        $this->setConfig('grid.borderColor', $borderColor);

        return $this;
    }

    /**
     * Creates dashes in borders of svg path. Higher number creates more space between dashes in the border.
     *
     * @param int $strokeDashArray
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridStrokeDashArray(int $strokeDashArray): self
    {
        $this->setConfig('grid.strokeDashArray', $strokeDashArray);

        return $this;
    }

    /**
     * Whether to place grid behind chart paths of in front.
     * Available options for position:
     *  - front
     *  - back
     *
     * @param string $position
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridPosition(string $position): self
    {
        $valid = ['front', 'back'];
        if (!in_array($position, $valid)) {
            throw new ApexChartWrongOptionException('grid.position', $position, $valid);
        }
        $this->setConfig('grid.position', $position);

        return $this;
    }

    /**
     * Whether to show/hide x-axis lines
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridXaxisLinesShow(bool $show): self
    {
        $this->setConfig('grid.xaxis.lines.show', $show);

        return $this;
    }

    /**
     * Whether to show/hide y-axis lines
     *
     * @param bool $show
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridYaxisLinesShow(bool $show): self
    {
        $this->setConfig('grid.yaxis.lines.show', $show);

        return $this;
    }

    /**
     * Grid background colors filling in row pattern.
     * Each row will be filled with colors based on the index in this array.
     * If less colors are specified, colors are repeated.
     *
     * @param array $colors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridRowColors(array $colors): self
    {
        foreach ($colors as $color) {
            Colors::validateColorOrFail($color);
        }
        $this->setConfig('grid.row.colors', $colors);

        return $this;
    }

    /**
     * Opacity of the row background colors.
     * Accepts values from 0 to 1
     *
     * @param float $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridRowOpacity(float $opacity): self
    {
        $this->setConfig('grid.row.opacity', $opacity);

        return $this;
    }

    /**
     * Grid background colors filling in column pattern.
     * Each column will be filled with colors based on the index in this array.
     * If less colors are specified, colors are repeated.
     *
     * @param array $colors
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridColumnColors(array $colors): self
    {
        foreach ($colors as $color) {
            Colors::validateColorOrFail($color);
        }
        $this->setConfig('grid.column.colors', $colors);

        return $this;
    }

    /**
     * Opacity of the column background colors.
     * Accepts values from 0 to 1
     *
     * @param float $opacity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridColumnOpacity(float $opacity): self
    {
        $this->setConfig('grid.column.opacity', $opacity);

        return $this;
    }

    /**
     * Grid padding from top
     *
     * @param int $top
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridPaddingTop(int $top): self
    {
        $this->setConfig('grid.padding.top', $top);

        return $this;
    }

    /**
     * Grid padding from right
     *
     * @param int $right
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridPaddingRight(int $right): self
    {
        $this->setConfig('grid.padding.right', $right);

        return $this;
    }

    /**
     * Grid padding from bottom
     *
     * @param int $bottom
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridPaddingBottom(int $bottom): self
    {
        $this->setConfig('grid.padding.bottom', $bottom);

        return $this;
    }

    /**
     * Grid padding from left
     *
     * @param int $left
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\GridTrait
     */
    public function setGridPaddingLeft(int $left): self
    {
        $this->setConfig('grid.padding.left', $left);

        return $this;
    }

}