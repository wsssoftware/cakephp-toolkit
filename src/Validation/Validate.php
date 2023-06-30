<?php
declare(strict_types = 1);


namespace Toolkit\Validation;


class Validate
{
    use ValidationTrait;

    /**
     * Validate a CPF
     * @param string $cpfNumber Number with or without mask containing 11 digits
     * @return bool
     */
    public static function cpf(string $cpfNumber)
    {
        $validate = new Validate();
        return $validate->_cpf($cpfNumber);
    }

    /**
     * Validate a CNPJ
     * @param string $cnpjNumber Number with or without mask containing 14 digits
     * @return bool
     */
    public static function cnpj(string $cnpjNumber)
    {
        $validate = new Validate();
        return $validate->_cnpj($cnpjNumber);
    }

    /**
     * Validate a RG
     * @param string $rgNumber Number with or without mask containing 8 to 11 digits
     * @return bool
     */
    public static function rg(string $rgNumber)
    {
        $validate = new Validate();
        return $validate->_rg($rgNumber);
    }

    /**
     * Validate a phone
     * @param string $phoneNumber
     * @param int $type
     * @return bool
     */
    public static function phone(string $phoneNumber, $type = 0)
    {
        $validate = new Validate();
        return $validate->_phone($phoneNumber, $type);
    }

    /**
     * Validate a cep
     * @param string $cepNumber Number with or without mask containing 8 digits
     * @return bool
     */
    public static function cep(string $cepNumber)
    {
        $validate = new Validate();
        return $validate->_cep($cepNumber);
    }
}