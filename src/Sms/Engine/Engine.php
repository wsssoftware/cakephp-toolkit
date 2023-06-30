<?php

declare(strict_types = 1);


namespace Toolkit\Sms\Engine;


use Cake\Datasource\ModelAwareTrait;

/**
 * Class Engine
 *
 * @property \Toolkit\Model\Table\SmsLogsTable $SmsLogs
 */
abstract class Engine implements EngineInterface
{

    use ModelAwareTrait;

    /**
     * Engine constructor.
     */
    public function __construct()
    {
        $this->loadModel('Toolkit.SmsLogs');
        $this->initialize();
    }

    /**
     * Initialize method
     */
    public function initialize(): void
    {
    }

    /**
     * @param array $phones
     * @param string $message
     * @return bool
     */
    public function sendToMany(array $phones, string $message): bool
    {
        $everythingOk = true;
        foreach ($phones as $phone) {
            if (!$this->send($phone, $message)) {
                $everythingOk = false;
            }
        }
        return $everythingOk;
    }

    /**
     * @param string $cellphone
     * @return bool
     */
    protected function _isValidCellphone(string $cellphone): bool
    {
        if (strlen($cellphone) == 10) {
            $exp_regular = '/^[1-9]{2}[5-9][0-9]{7}$/';
        } elseif (strlen($cellphone) == 11) {
            $exp_regular = '/^[1-9]{2}[9][5-9][0-9]{7}$/';
        } else {
            return false;
        }
        $ret = preg_match($exp_regular, $cellphone);
        if ($ret === 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $text
     * @return string
     */
    protected function _removeAccents(string $text): string
    {
        $pattern = [
            "/(á|à|ã|â|ä)/",
            "/(Á|À|Ã|Â|Ä)/",
            "/(é|è|ê|ë)/",
            "/(É|È|Ê|Ë)/",
            "/(í|ì|î|ï)/",
            "/(Í|Ì|Î|Ï)/",
            "/(ó|ò|õ|ô|ö)/",
            "/(Ó|Ò|Õ|Ô|Ö)/",
            "/(ú|ù|û|ü)/",
            "/(Ú|Ù|Û|Ü)/",
            "/(ñ)/",
            "/(Ñ)/",
            "/(ç)/",
            "/(Ç)/"
        ];
        $replacement = ['a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'n', 'N', 'c', 'C'];
        return preg_replace($pattern, $replacement, $text);
    }


}