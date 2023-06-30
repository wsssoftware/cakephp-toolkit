<?php


declare(strict_types = 1);

namespace Toolkit\Session;

use Cake\Error\FatalErrorException;
use Exception;

class SessionTools
{

    /**
     * @param $session_data
     * @return array
     * @throws \Exception
     */
    public static function unserialize($session_data): array
    {
        $method = ini_get("session.serialize_handler");

        return match ($method) {
            "php" => self::unserializePhp($session_data),
            "php_binary" => self::unserializePhpbinary($session_data),
            default => throw new Exception("Unsupported session.serialize_handler: " . $method . ". Supported: php, php_binary"),
        };
    }

    /**
     * @param $sessionData
     * @return array
     * @throws \Exception
     */
    private static function unserializePhp($sessionData): array
    {
        $returnData = array();
        $offset = 0;
        while ($offset < strlen($sessionData)) {
            if (!strstr(substr($sessionData, $offset), "|")) {
                throw new Exception("invalid data, remaining: " . substr($sessionData, $offset));
            }
            $pos = strpos($sessionData, "|", $offset);
            $num = $pos - $offset;
            $varName = substr($sessionData, $offset, $num);
            $offset += $num + 1;
            $data = unserialize(substr($sessionData, $offset));
            $returnData[$varName] = $data;
            $offset += strlen(serialize($data));
        }

        return $returnData;
    }

    /**
     * @param $sessionData
     * @return array
     */
    private static function unserializePhpbinary($sessionData): array
    {
        $returnData = array();
        $offset = 0;
        while ($offset < strlen($sessionData)) {
            $num = ord($sessionData[$offset]);
            $offset += 1;
            $varName = substr($sessionData, $offset, $num);
            $offset += $num;
            $data = unserialize(substr($sessionData, $offset));
            $returnData[$varName] = $data;
            $offset += strlen(serialize($data));
        }

        return $returnData;
    }

    /**
     * @param string $sessionId
     * @return array
     * @throws \Exception
     */
    public static function getSessionById(string $sessionId): array
    {
        $sessionPath = session_save_path() . DS . 'sess_' . $sessionId;
        if (!file_exists($sessionPath)) {
            throw new FatalErrorException(sprintf('The needed file session "%s" not found on server', $sessionPath));
        }

        return self::unserialize(file_get_contents($sessionPath));
    }
}