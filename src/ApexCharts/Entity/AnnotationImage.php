<?php
declare(strict_types = 1);


namespace Toolkit\ApexCharts\Entity;


use Cake\Core\InstanceConfigTrait;
use Toolkit\Exception\ApexChartWrongOptionException;

class AnnotationImage
{
    use InstanceConfigTrait;

    /**
     * Default config for annotation.
     *
     * @var array
     */
    protected array $_defaultConfig = [];

    /**
     * An absolute path to the image
     *
     * @param string $path
     * @return $this
     */
    public function setPath(string $path): self
    {
        $this->setConfig('path', $path);

        return $this;
    }

    /**
     * Left position for the image relative to the element specified in appendTo property
     *
     * @param float|int|string $x
     * @return $this
     */
    public function setX(float|int|string $x): self
    {
        $this->setConfig('x', $x);

        return $this;
    }

    /**
     * Top position for the image relative to the element specified in appendTo property
     *
     * @param float|int $y
     * @return $this
     */
    public function setY(float|int $y): self
    {
        $this->setConfig('y', $y);

        return $this;
    }

    /**
     * The width of the image
     *
     * @param int $width
     * @return $this
     */
    public function setWidth(int $width): self
    {
        $this->setConfig('width', $width);

        return $this;
    }

    /**
     * The height of the image
     *
     * @param int $height
     * @return $this
     */
    public function setHeight(int $height): self
    {
        $this->setConfig('height', $height);

        return $this;
    }

    /**
     * A query selector to which the image element will be appended.
     *
     * @param string $appendTo
     * @return $this
     */
    public function setAppendTo(string $appendTo): self
    {
        $this->setConfig('appendTo', $appendTo);

        return $this;
    }


}