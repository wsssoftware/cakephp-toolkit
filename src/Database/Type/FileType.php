<?php
declare(strict_types=1);

namespace Toolkit\Database\Type;


use Cake\Database\DriverInterface;
use Laminas\Diactoros\UploadedFile;
use Toolkit\Upload\FileContainer;

class FileType extends \Cake\Database\Type\BaseType
{

    /**
     * @param FileContainer $value
     * @param \Cake\Database\DriverInterface $driver
     * @return mixed|void
     * @inheritDoc
     */
    public function toDatabase($value, DriverInterface $driver)
    {
       if (!$value instanceof FileContainer || empty($value->getFilename()) || empty($value->getPath())) {
           return null;
       }
       $data = [
           'filename' => $value->getFilename(),
           'path' => $value->getPath(),
       ];

       return json_encode($data);
    }

    /**
     * @inheritDoc
     */
    public function toPHP($value, DriverInterface $driver)
    {
        if (empty($value)) {
            return null;
        }

        return new FileContainer(json_decode($value, true));
    }

    /**
     * @param \Laminas\Diactoros\UploadedFile $value
     * @return mixed
     *
     * @inheritDoc
     */
    public function marshal($value)
    {
        return $value;
    }
}