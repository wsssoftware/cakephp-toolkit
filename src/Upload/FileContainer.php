<?php

declare(strict_types = 1);


namespace Toolkit\Upload;


use Cake\Cache\Cache;
use Cake\Cache\Engine\FileEngine;
use Cake\Error\FatalErrorException;
use Cake\Filesystem\File;
use Cake\Routing\Router;
use finfo;
use Laminas\Diactoros\Stream;
use Laminas\Diactoros\UploadedFile;
use Psr\Http\Message\StreamInterface;
use RuntimeException;
use SplFileObject;
use Symfony\Component\Finder\SplFileInfo;

class FileContainer
{

    const CACHE_DOWNLOAD_KEY = '_toolkit_download_';

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var null|StreamInterface
     */
    private $stream;

    /**
     * FileContainer constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (empty($data['path']) || empty($data['filename'])) {
            throw new FatalErrorException('Missing data on "data" array in construct method');
        }
        $this->path = $data['path'];
        if (substr($this->path, -1, 1) !== DS) {
            $this->path .= DS;
        }
        $this->filename = $data['filename'];
    }

    public static function setCacheDownloadConfig(): void
    {
        if (empty(Cache::getConfig(FileContainer::CACHE_DOWNLOAD_KEY))) {
            Cache::setConfig(FileContainer::CACHE_DOWNLOAD_KEY, [
                'className' => FileEngine::class,
                'prefix' => 'download_',
                'path' => CACHE . 'toolkit' . DS . 'download' . DS,
                'serialize' => true,
                'duration' => '+30 days',
                'url' => env('CACHE_CAKEROUTES_URL', null),
            ]);
        }
    }

    public function delete(): bool
    {
        return unlink($this->getPath() . $this->getFilename());
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    public function getPathAndFile(): string
    {
        return $this->path . $this->filename;
    }

    /**
     * @param bool $isDownload
     * @param bool $full
     * @return string
     */
    public function getFileUrl(bool $isDownload = false, bool $full = true): string
    {
        self::setCacheDownloadConfig();
        $cacheKey = uniqid('authorization_', true);
        Cache::write($cacheKey, $this, FileContainer::CACHE_DOWNLOAD_KEY);

        $isDownload = $isDownload ? 1 : 0;
        return Router::url(['plugin' => 'Toolkit', 'prefix' => false, 'controller' => 'Files', 'action' => 'upload', $isDownload, $cacheKey, $this->filename], $full) . '?' . $this->getLastModified();
    }

    public function getStream(): StreamInterface
    {
        return new Stream($this->getPathAndFile());
    }

    /**
     * @return \SplFileObject|null
     */
    private function getSplFileObject(): ?SplFileObject
    {
        try {
            $file = new SplFileObject($this->getPathAndFile());
        } catch (RuntimeException $exception) {
            return null;
        }
        return $file;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
       return mime_content_type($this->getPathAndFile());
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {

        $file = $this->getSplFileObject();
        if (empty($file)) {
            return null;
        }
        return $file->getSize();
    }

    /**
     * @return int|null
     */
    public function getLastModified(): ?int
    {

        $file = $this->getSplFileObject();
        if (empty($file)) {
            return null;
        }
        return $file->getMTime();
    }

    /**
     * @return string|null
     */
    public function getExtension(): ?string
    {

        $file = $this->getSplFileObject();
        if (empty($file)) {
            return null;
        }
        return $file->getExtension();
    }

    /**
     * @return string|null
     */
    public function getFileMd5(): ?string
    {
        if (!is_file($this->getPathAndFile())) {
            return null;
        }

        return md5_file($this->getPathAndFile());
    }

}