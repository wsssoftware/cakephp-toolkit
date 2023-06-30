<?php
declare(strict_types = 1);


namespace Toolkit\Utilities;

class Mask
{
    use MaskTrait;

    /**
     * Format a CPF
     * @param string|null $cpfNumber CPF number to be formatted
     * @return string
     */
    public static function cpf(?string $cpfNumber)
    {
        $mask = new Mask();
        return $mask->_cpf($cpfNumber);
    }

    /**
     * Format a CNPJ
     * @param string|null $cnpjNumber CNPJ number to be formatted
     * @return string
     */
    public static function cnpj(?string $cnpjNumber)
    {
        $mask = new Mask();
        return $mask->_cnpj($cnpjNumber);
    }

    /**
     * Format a Document
     * @param string|null $document Document number to be formatted
     * @return string
     */
    public static function document(?string $document)
    {
        $mask = new Mask();
        return $mask->_document($document);
    }

    /**
     * Format a RG
     * @param string|null $rgNumber RG number to be formatted
     * @return string
     */
    public static function rg(?string $rgNumber)
    {
        $mask = new Mask();
        return $mask->_rg($rgNumber);
    }

    /**
     * Foramt a phone number
     * @param string|null $phoneNumber PHONE number to be formatted
     * @return string
     */
    public static function phone(?string $phoneNumber)
    {
        $mask = new Mask();
        return $mask->_phone($phoneNumber);
    }

    /**
     * Format a CEP
     * @param string|null $cepNumber CEP number to be formatted
     * @return string
     */
    public static function cep(?string $cepNumber)
    {
        $mask = new Mask();
        return $mask->_cep($cepNumber);
    }

    /**
     * Format a custom mask
     * @param string $value
     * @param string $mask
     * @return string
     */
    public static function custom(string $value, string $mask)
    {
        $maskClass = new Mask();
        return $maskClass->_custom($value, $mask);
    }

    /**
     * Remove mask special chars from string
     * @param string $string
     */
    public static function removeMask(string &$string = 'as')
    {
        $maskClass = new Mask();
        $maskClass->_removeMask($string);
    }
}