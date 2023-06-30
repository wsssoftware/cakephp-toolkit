<?php
declare(strict_types = 1);

namespace Toolkit\Utilities;

class Numbers
{

    /**
     * @param float $number
     * @param int $precision
     * @return float
     */
    public static function roundUp(float $number, int $precision = 0): float
    {
        $precision++;
        $fig = (int) str_pad('1', $precision, '0');
        return (ceil($number * $fig) / $fig);
    }

    /**
     * @param float $number
     * @param int $precision
     * @return float
     */
    public static function roundDown(float $number, int $precision = 0): float
    {
        $precision++;
        $fig = (int) str_pad('1', $precision, '0');
        return (floor($number * $fig) / $fig);
    }
}
