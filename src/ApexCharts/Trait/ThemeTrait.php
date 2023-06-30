<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\Exception\ApexChartWrongOptionException;
use Toolkit\Utilities\Colors;

trait ThemeTrait
{

    /**
     * Changing the theme.mode will also update the text and background colors of the chart.
     * Available Options:
     *  - light
     *  - dark
     *
     * @param string $mode
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setThemeMode(string $mode): self
    {
        $valid = ['light', 'dark'];
        if (!in_array($mode, $valid)) {
            throw new ApexChartWrongOptionException('theme.mode', $mode, $valid);
        }
        $this->setConfig('theme.mode', $mode);

        return $this;
    }

    /**
     * Available palettes – palette1 to palette10
     *
     * @param string $palette
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setThemePalette(string $palette): self
    {
        $valid = ['palette1', 'palette2', 'palette3', 'palette4', 'palette5', 'palette6', 'palette7', 'palette8', 'palette9', 'palette10'];
        if (!in_array($palette, $valid)) {
            throw new ApexChartWrongOptionException('theme.mode', $palette, $valid);
        }
        $this->setConfig('theme.palette', $palette);

        return $this;
    }

    /**
     * Whether to enable monochrome theme option.
     *
     * @param bool $enabled
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setThemeMonochromeEnabled(bool $enabled): self
    {
        $this->setConfig('theme.monochrome.enabled', $enabled);

        return $this;
    }

    /**
     * A hex color which will be used as the base color for generating shades
     *
     * @param string $color
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setThemeMonochromeColor(string $color): self
    {
        Colors::validateColorOrFail($color);
        $this->setConfig('theme.monochrome.color', $color);

        return $this;
    }

    /**
     * Accepts either light or dark
     *
     * @param string $shadeTo
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setThemeMonochromeShadeTo(string $shadeTo): self
    {
        $valid = ['light', 'dark'];
        if (!in_array($shadeTo, $valid)) {
            throw new ApexChartWrongOptionException('theme.monochrome.shadeTo', $shadeTo, $valid);
        }
        $this->setConfig('theme.monochrome.shadeTo', $shadeTo);

        return $this;
    }

    /**
     * What should be the intensity while generating shades Accepts from 0 to 1
     *
     * @param float $shadeIntensity
     * @return \Toolkit\ApexCharts\ApexChart|\Toolkit\ApexCharts\Trait\SubtitleTrait
     */
    public function setThemeMonochromeShadeIntensity(float $shadeIntensity): self
    {
        $this->setConfig('theme.monochrome.shadeIntensity', $shadeIntensity);

        return $this;
    }

}