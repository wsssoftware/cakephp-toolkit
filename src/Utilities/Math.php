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
        if (empty($data)) {
            return 0.0;
        }
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


    /**
     * @param float $value
     * @param float $min
     * @param float $max
     * @return float
     */
    public static function getInversePercentualOfValueBetweenMaxAndMin(float $value, float $min, float $max): float
    {
        if ($min >= $max) {
            throw new FatalErrorException('Min must to be lower than max.');
        }
        if ($value < $min) {
            return 100;
        }
        if ($value > $max) {
            return 0;
        }
        $step = 100 / ($max - $min);
        $value -= $min;

        return 100 - ($value * $step);
    }

    /**
     * @param int $number
     * @return bool
     */
    public static function numberIsOdd(int $number): bool
    {
        return $number % 2 !== 0;
    }

    /**
     * @param int $number1
     * @param int $number2
     * @return bool
     */
    public static function hasTheSameUnitNumber(int $number1, int $number2): bool
    {
        $number1 = (int)substr((string)$number1, -1, 1);
        $number2 = (int)substr((string)$number2, -1, 1);

        return $number1 === $number2;
    }

    /**
     * @param int $number
     * @return bool
     */
    public static function numberIsEven(int $number): bool
    {
        return $number % 2 === 0;
    }

    /**
     * @param float $percent
     * @return float
     */
    public static function convertPercentFromSubtractionToSum(float $percent): float
    {
        $increment = 10 * (1 + ($percent));
        $decrement = $increment * (1 - ($percent));
        return (($increment / $decrement) - 1);
    }

    public static function floorDecimal(float|int $value, int $precision): float
    {
        if ($precision < 0) {
            throw new FatalErrorException('Precision must to be greater or equals than 0');
        }
        $multiplier = pow(10, $precision);

        return floor($value * $multiplier) / $multiplier;
    }
}
