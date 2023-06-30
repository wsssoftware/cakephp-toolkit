<?php
declare(strict_types=1);

namespace Toolkit\Database\Type;


use Cake\Database\DriverInterface;
use Cake\Database\Type\BaseType;
use UnitEnum;

class EnumType extends BaseType
{

    /**
     * @inheritDoc
     */
    public function toDatabase($value, DriverInterface $driver): ?string
    {
       if (!$value instanceof UnitEnum || empty($value)) {
           return null;
       }

       return serialize($value);
    }

    /**
     * @inheritDoc
     */
    public function toPHP($value, DriverInterface $driver)
    {
        if (empty($value)) {
            return null;
        }

        return unserialize($value);
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