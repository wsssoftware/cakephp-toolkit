<?php

declare(strict_types = 1);


namespace Toolkit\ApexCharts\Trait;


use Toolkit\ApexCharts\Entity\AnnotationImage;
use Toolkit\ApexCharts\Entity\AnnotationPoint;
use Toolkit\ApexCharts\Entity\AnnotationText;
use Toolkit\ApexCharts\Entity\AnnotationX;
use Toolkit\ApexCharts\Entity\AnnotationY;
use Toolkit\Exception\ApexChartWrongOptionException;

trait AnnotationsTrait
{

    /**
     * @var \Toolkit\ApexCharts\Entity\AnnotationImage[]
     */
    protected array $_annotationsImages = [];

    /**
     * @var \Toolkit\ApexCharts\Entity\AnnotationPoint[]
     */
    protected array $_annotationsPoints = [];

    /**
     * @var \Toolkit\ApexCharts\Entity\AnnotationText[]
     */
    protected array $_annotationsTexts = [];

    /**
     * @var \Toolkit\ApexCharts\Entity\AnnotationX[]
     */
    protected array $_annotationsXaxis = [];

    /**
     * @var \Toolkit\ApexCharts\Entity\AnnotationY[]
     */
    protected array $_annotationsYaxis = [];

    /**
     * Whether to put the annotations behind the charts or in front of it.
     * Available Options:
     *  - front
     *  - back
     *
     * @param string $position
     * @return \Toolkit\ApexCharts\Trait\AnnotationsTrait|\Toolkit\ApexCharts\ApexChart
     */
    public function setAnnotationsPosition(string $position): self
    {
        $valid = ['front', 'back'];
        if (!in_array($position, $valid)) {
            throw new ApexChartWrongOptionException('annotations.position', $position, $valid);
        }
        $this->setConfig('annotations.position', $position);

        return $this;
    }

    /**
     * @return \Toolkit\ApexCharts\Trait\AnnotationsTrait|\Toolkit\ApexCharts\ApexChart
     */
    public function clearAnnotationsImages(): self
    {
        $this->_annotationsImages = [];

        return $this;
    }

    /**
     * @return \Toolkit\ApexCharts\Trait\AnnotationsTrait|\Toolkit\ApexCharts\ApexChart
     */
    public function clearAnnotationsPoints(): self
    {
        $this->_annotationsPoints = [];

        return $this;
    }

    /**
     * @return \Toolkit\ApexCharts\Trait\AnnotationsTrait|\Toolkit\ApexCharts\ApexChart
     */
    public function clearAnnotationsTexts(): self
    {
        $this->_annotationsTexts = [];

        return $this;
    }

    /**
     * @return \Toolkit\ApexCharts\Trait\AnnotationsTrait|\Toolkit\ApexCharts\ApexChart
     */
    public function clearAnnotationsXaxis(): self
    {
        $this->_annotationsXaxis = [];

        return $this;
    }

    /**
     * @return \Toolkit\ApexCharts\Trait\AnnotationsTrait|\Toolkit\ApexCharts\ApexChart
     */
    public function clearAnnotationsYaxis(): self
    {
        $this->_annotationsXaxis = [];

        return $this;
    }

    /**
     * @param string $path
     * @param mixed $x
     * @param mixed $y
     * @return \Toolkit\ApexCharts\Entity\AnnotationImage
     */
    public function addAnnotationImage(string $path, mixed $x, mixed $y): AnnotationImage
    {
        $annotationImage = new AnnotationImage();
        $annotationImage->setPath($path);
        $annotationImage->setX($x);
        $annotationImage->setY($y);
        $this->_annotationsImages[] = $annotationImage;

        return $annotationImage;
    }

    /**
     * @param mixed|null $x
     * @param mixed $y
     * @return \Toolkit\ApexCharts\Entity\AnnotationPoint
     */
    public function addAnnotationPoint(mixed $x, mixed $y): AnnotationPoint
    {
        $annotationPoint = new AnnotationPoint();
        $annotationPoint->setX($x);
        $annotationPoint->setY($y);
        $this->_annotationsPoints[] = $annotationPoint;

        return $annotationPoint;
    }

    /**
     * @param string $text
     * @param mixed|null $x
     * @param mixed $y
     * @return \Toolkit\ApexCharts\Entity\AnnotationText
     */
    public function addAnnotationText(string $text, mixed $x, mixed $y): AnnotationText
    {
        $annotationText = new AnnotationText();
        $annotationText->setText($text);
        $annotationText->setX($x);
        $annotationText->setY($y);
        $this->_annotationsTexts[] = $annotationText;

        return $annotationText;
    }

    /**
     * @param string $text
     * @param mixed|null $x
     * @param mixed|null $x2
     * @return \Toolkit\ApexCharts\Entity\AnnotationX
     */
    public function addAnnotationX(string $text, mixed $x = null, mixed $x2 = null): AnnotationX
    {
        $annotationX = new AnnotationX();
        $annotationX->setLabelText($text);
        if ($x !== null) {
            $annotationX->setX($x);
        }
        if ($x2 !== null) {
            $annotationX->setX2($x2);
        }
        $this->_annotationsXaxis[] = $annotationX;

        return $annotationX;
    }

    /**
     * @param string $text
     * @param mixed|null $y
     * @param mixed|null $y2
     * @return \Toolkit\ApexCharts\Entity\AnnotationY
     */
    public function addAnnotationY(string $text, mixed $y = null, mixed $y2 = null): AnnotationY
    {
        $annotationY = new AnnotationY();
        $annotationY->setLabelText($text);
        if ($y !== null) {
            $annotationY->setY($y);
        }
        if ($y2 !== null) {
            $annotationY->setY2($y2);
        }
        $this->_annotationsYaxis[] = $annotationY;

        return $annotationY;
    }

    /**
     * @param int $index
     * @return \Toolkit\ApexCharts\Entity\AnnotationImage|null
     */
    public function getAnnotationImage(int $index): AnnotationImage|null
    {
        if (empty($this->_annotationsImages[$index])) {
            return null;
        }

        return $this->_annotationsImages[$index];
    }

    /**
     * @param int $index
     * @return \Toolkit\ApexCharts\Entity\AnnotationPoint|null
     */
    public function getAnnotationPoint(int $index): AnnotationPoint|null
    {
        if (empty($this->_annotationsPoints[$index])) {
            return null;
        }

        return $this->_annotationsPoints[$index];
    }

    /**
     * @param int $index
     * @return \Toolkit\ApexCharts\Entity\AnnotationText|null
     */
    public function getAnnotationText(int $index): AnnotationText|null
    {
        if (empty($this->_annotationsTexts[$index])) {
            return null;
        }

        return $this->_annotationsTexts[$index];
    }

    /**
     * @param int $index
     * @return \Toolkit\ApexCharts\Entity\AnnotationX|null
     */
    public function getAnnotationX(int $index): AnnotationX|null
    {
        if (empty($this->_annotationsXaxis[$index])) {
            return null;
        }

        return $this->_annotationsXaxis[$index];
    }

    /**
     * @param int $index
     * @return \Toolkit\ApexCharts\Entity\AnnotationY|null
     */
    public function getAnnotationY(int $index): AnnotationY|null
    {
        if (empty($this->_annotationsYaxis[$index])) {
            return null;
        }

        return $this->_annotationsYaxis[$index];
    }

    /**
     * @return \Toolkit\ApexCharts\Entity\AnnotationImage[]
     */
    public function getAnnotationsImages(): array
    {
        return $this->_annotationsImages;
    }

    /**
     * @return \Toolkit\ApexCharts\Entity\AnnotationPoint[]
     */
    public function getAnnotationsPoints(): array
    {
        return $this->_annotationsPoints;
    }

    /**
     * @return \Toolkit\ApexCharts\Entity\AnnotationText[]
     */
    public function getAnnotationsTexts(): array
    {
        return $this->_annotationsTexts;
    }

    /**
     * @return \Toolkit\ApexCharts\Entity\AnnotationX[]
     */
    public function getAnnotationsX(): array
    {
        return $this->_annotationsXaxis;
    }

    /**
     * @return \Toolkit\ApexCharts\Entity\AnnotationY[]
     */
    public function getAnnotationsY(): array
    {
        return $this->_annotationsYaxis;
    }

    /**
     * @return void
     */
    protected function _setAnnotationsOptions(): void
    {
        if (!empty($this->_annotationsImages)) {
            $images = [];
            foreach ($this->_annotationsImages as $annotationsImage) {
                $images[] = $annotationsImage->getConfig();
            }
            $this->setConfig('annotations.images', $images);
        }
        if (!empty($this->_annotationsPoints)) {
            $points = [];
            foreach ($this->_annotationsPoints as $annotationPoint) {
                $points[] = $annotationPoint->getConfig();
            }
            $this->setConfig('annotations.points', $points);
        }
        if (!empty($this->_annotationsTexts)) {
            $texts = [];
            foreach ($this->_annotationsTexts as $annotationsText) {
                $texts[] = $annotationsText->getConfig();
            }
            $this->setConfig('annotations.texts', $texts);
        }
        if (!empty($this->_annotationsXaxis)) {
            $xaxis = [];
            foreach ($this->_annotationsXaxis as $annotation) {
                $xaxis[] = $annotation->getConfig();
            }
            $this->setConfig('annotations.xaxis', $xaxis);
        }
        if (!empty($this->_annotationsYaxis)) {
            $yaxis = [];
            foreach ($this->_annotationsYaxis as $annotation) {
                $yaxis[] = $annotation->getConfig();
            }
            $this->setConfig('annotations.yaxis', $yaxis);
        }
    }
}