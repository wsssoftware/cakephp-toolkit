<?php

declare(strict_types = 1);

namespace Toolkit\Utilities;

use Cake\Error\FatalErrorException;
use Cake\I18n\Number;

class Math
{

    /**
     * @var int
     */
    protected static int $maxSumItems = 30;

    /**
     * This functions get a sum of numbers of base power 2 and decompose it to discovery
     * what numbers was added to the sum.
     *
     * @param int $sum The sum value to be decomposed.
     * @return array
     */
    public static function decomposeSum(int $sum): array
    {
        $exponent = self::getMaxSumItems() - 1;
        $maxItem = pow(2, $exponent);
        $maxAllowedSum = ($maxItem * 2) - 1;
        $result = [];
        if ($sum < 0) {
            throw new FatalErrorException('Sum must to be a positive integer.');
        }
        if ($sum > $maxAllowedSum) {
            throw new FatalErrorException(
                sprintf(
                    'Base power 2 is using exponent %s, so the maximum allowed sum is %s. Found: %s.',
                    $exponent,
                    Number::format($maxAllowedSum),
                    Number::format($sum)
                )
            );
        }
        // Sum decompose algorithm by Allan Carvalho
        for ($i = $maxItem; $i >= 1; $i = $i / 2) {
            if ($sum >= $i && $sum < 2 * $i) {
                $result[$i] = true;
                $sum -= $i;
            } else {
                $result[$i] = false;
            }
        }
        ksort($result);

        return $result;
    }

    /**
     * @return int
     */
    public static function getMaxSumItems(): int
    {
        return self::$maxSumItems;
    }

    /**
     * @param int $maxSumItems
     */
    public static function setMaxSumItems(int $maxSumItems): void
    {
        self::$maxSumItems = $maxSumItems;
    }

    /**
     * @param array $data
     * @return float
     */
    public static function standardDeviation(array $data): float
    {
        $numberOfElements = count($data);
        $variance = 0.0;
        $average = array_sum($data)/$numberOfElements;

        foreach($data as $value)
        {
            $variance += pow(($value - $average), 2);
        }

        return sqrt($variance/$numberOfElements);
    }

    /**
     * @param array $items
     * @return float
     */
    public static function minNormalCurve(array $items): float
    {
        $standardDeviation = self::standardDeviation($items);
        $average = array_sum($items)/count($items);

        return $average - 1.64 * ($standardDeviation / pow(count($items), 0.5));
    }

    /**
     * @param array $items
     * @return float
     */
    public static function maxNormalCurve(array $items): float
    {
        $standardDeviation = self::standardDeviation($items);
        $average = array_sum($items)/count($items);

        return $average + 1.64 * ($standardDeviation / pow(count($items), 0.5));
    }

    /**
     * @param array $items
     * @return array
     */
    public static function removeFromArrayOutFromNormalCurve(array $items): array
    {
        $min = self::minNormalCurve($items);
        $max = self::maxNormalCurve($items);
        foreach ($items as $key => $item) {
            if ($item > $max || $item < $min) {
                unset($items[$key]);
            }
        }
        return $items;
    }
}
