<?php

declare(strict_types = 1);


namespace Toolkit\Sms\Engine;


use Cake\Log\Log;
use Cake\Utility\Hash;

class SinchEngine extends Engine
{
    protected const USER = '';
    protected const PASSWORD = '';
    protected const WEBSERVICE = 'https://webservices.twwwireless.com.br/reluzcap/';

    protected TWWLibrary $TWWLibrary;

    public function initialize(): void
    {
        parent::initialize();
        $this->TWWLibrary = new TWWLibrary([
            'numusu' => self::USER,
            'senha' => self::PASSWORD,
            'url' => self::WEBSERVICE,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function send(string $phone, string $message): bool
    {
        if (strlen($message) > 160) {
            Log::error('Error on send SMS. String length is greater than 160 chars.');

            return false;
        }
        if (strlen($message) === 0) {
            Log::error('Error on send SMS. String length is zero.');

            return false;
        }
        if (!$this->_isValidCellphone($phone)) {
            Log::error(sprintf('Error on send SMS. Phone %s is invalid.', $phone));

            return false;
        }
        $return = (array)$this->TWWLibrary->EnviaSMS("55$phone", $this->_removeAccents($message));
        $return = Hash::get($return, '0', 'Error');
        if ($return === 'OK') {
            $this->SmsLogs->log($phone, $message);
            return true;
        } elseif ($return === 'NOK') {
            Log::error('Error on send SMS. Message not accepted by TWW');
        } elseif ($return === 'Erro') {
            Log::error('Error on send SMS.');
        } elseif ($return === 'NA') {
            Log::error('Error on send SMS. TWW system was unavailable');
        }

        return false;
    }
}
