<?php

declare(strict_types = 1);

namespace Toolkit\Controller;

use Cake\Cache\Cache;
use Cake\Http\Exception\MethodNotAllowedException;
use Cake\Http\Exception\NotFoundException;
use Toolkit\Upload\FileContainer;

/**
 * Files Controller
 * @method \Toolkit\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
    public function upload($isDownload = false, $authorization = null)
    {
        FileContainer::setCacheDownloadConfig();
        /** @var FileContainer $fileContainer */
        $fileContainer = Cache::read($authorization, FileContainer::CACHE_DOWNLOAD_KEY);
        if (empty($fileContainer) || !$fileContainer instanceof FileContainer) {
            throw new MethodNotAllowedException('File not found or the request is not authorized');
        }
        Cache::delete($authorization, FileContainer::CACHE_DOWNLOAD_KEY);
        $isDownload = (bool)$isDownload;

        $response = $this->getResponse()
                         ->withType($fileContainer->getMimeType())
                         ->withFile($fileContainer->getPathAndFile(), [
                             'download' => $isDownload
                         ]);

        return $response;
    }
}
