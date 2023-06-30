<?php
declare(strict_types = 1);


namespace Toolkit\Utilities;

class Arrays
{

    /**
     * @param array $data
     * @return void
     */
    public static function globalKSort(array &$data): void
    {
        ksort($data);
        foreach ($data as $key => $datum) {
            if (is_array($datum)) {
                self::globalKSort($datum);
                $data[$key] = $datum;
            }
        }
    }
}