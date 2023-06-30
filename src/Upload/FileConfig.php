<?php
declare(strict_types = 1);

namespace Toolkit\Upload;


class FileConfig
{

    /**
     * @var string
     */
    protected $column;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string|null
     */
    protected $filenamePrefix = null;

    public function __construct(string $column, string $path) {
        $this->column = $column;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string|null
     */
    public function getFilenamePrefix(): string
    {
        return !empty($this->filenamePrefix) ? $this->filenamePrefix : "";
    }

    /**
     * @param string|null $filenamePrefix
     * @return \Toolkit\Upload\FileConfig
     */
    public function setFilenamePrefix(?string $filenamePrefix): self
    {
        $this->filenamePrefix = $filenamePrefix;

        return $this;
    }




}