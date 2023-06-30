<?php
declare(strict_types=1);


namespace Toolkit\Sms\Engine;


interface EngineInterface
{

    /**
     * Send a message for a single phone number.
     *
     * @param string $phone
     * @param string $message
     * @return bool
     */
    public function send(string $phone, string $message): bool;
}