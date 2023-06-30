<?php
declare(strict_types = 1);

namespace Toolkit\Validation;

use Cake\I18n\Time;
use wapmorgan\MediaFile\Exceptions\Exception;

class WSSValidation
{
    use ValidationTrait;

    const INPUT_DATE_TIME_FORMAT = 'Y-m-d\TH:i:s';

    /**
     * Check if is valid phone
     *
     * @param string $check
     * @return boolean
     */
    public static function isValidPhone(string $check)
    {
        if (strlen($check) === 10) {
            $pattern = '/^(|[1-9]{2}[1-5]{1}[0-9]{3}[0-9]{4})$/';
        } else {
            $pattern = '/^(|[1-9]{2}[9][1-9]{1}[0-9]{3}[0-9]{4})$/';
        }

        return (bool)preg_match($pattern, $check);
    }

    /**
     * Check if is valid cellphone
     *
     * @param string $check
     * @return boolean
     */
    public static function isValidCellphone(string $check)
    {
        return (bool)preg_match('/^(|[1-9]{2}[9][1-9]{1}[0-9]{3}[0-9]{4})$/', $check);
    }

    /**
     * Check if is valid cellphone
     *
     * @param string $check
     * @return boolean
     */
    public static function isValidCpfOrCnpj(string $check)
    {
        if (strlen($check) <= 11) {
            return self::isValidCpf($check);
        }

        return self::isValidCnpj($check);
    }

    /**
     * Check if is valid cellphone
     *
     * @param string $check
     * @return boolean
     */
    public static function isValidCpf(string $check)
    {
        return Validate::cpf($check);
    }

    /**
     * Check if is valid cellphone
     *
     * @param string $check
     * @return boolean
     */
    public static function isValidCnpj(string $check)
    {
        return Validate::cnpj($check);
    }

    /**
     * Compare one field to another.
     *
     * Return true if the comparison matches the expected result.
     *
     * @param mixed $check The value to find in $field.
     * @param string $field The field to check $check against. This field must be present in $context.
     * @param array $context The validation context.
     * @return bool
     * @since 3.6.0
     */
    public static function isDateTimeLessThanField($check, string $field, array $context): bool
    {
        if (!isset($context['data']) || !array_key_exists($field, $context['data'])) {
            return false;
        }
        if (empty($context['data'][$field])) {
            return true;
        }
        try {
            $date1 = Time::createFromFormat(self::INPUT_DATE_TIME_FORMAT, $check);
            $date2 = Time::createFromFormat(self::INPUT_DATE_TIME_FORMAT, $context['data'][$field]);
        } catch (\InvalidArgumentException $exception) {
            return false;
        }

        return $date1->lessThan($date2);
    }

    /**
     * Compare one field to another.
     *
     * Return true if the comparison matches the expected result.
     *
     * @param mixed $check The value to find in $field.
     * @param string $field The field to check $check against. This field must be present in $context.
     * @param array $context The validation context.
     * @return bool
     * @since 3.6.0
     */
    public static function isDateTimeGreaterThanField($check, string $field, array $context): bool
    {
        if (!isset($context['data']) || !array_key_exists($field, $context['data'])) {
            return false;
        }
        if (empty($context['data'][$field])) {
            return true;
        }
        try {
            $date1 = Time::createFromFormat(self::INPUT_DATE_TIME_FORMAT, $check);
            $date2 = Time::createFromFormat(self::INPUT_DATE_TIME_FORMAT, $context['data'][$field]);
        } catch (\InvalidArgumentException $exception) {
            return false;
        }

        return $date1->greaterThan($date2);
    }
}