<?php
declare(strict_types=1);


namespace Toolkit\Sms;


use Cake\Core\InstanceConfigTrait;
use Cake\Error\FatalErrorException;
use Toolkit\Sms\Engine\Engine;
use Toolkit\Sms\Engine\SinchEngine;

class Sms
{

    use InstanceConfigTrait;

    /**
     * @var \Toolkit\Sms\Engine\Engine
     */
    protected Engine $_engine;

    /**
     * @var array
     */
    protected array $_defaultConfig = [
        'engine' => SinchEngine::class,
    ];

    /**
     * Sms constructor.
     */
    public function __construct(array $config = [])
    {
        $this->setConfig($config);
        $engineClass = $this->getConfig('engine');
        if (!class_exists($engineClass)) {
            throw new FatalErrorException('Engine class does not exists.');
        }
        $this->_engine = new $engineClass();
    }

    /**
     * @param string $phone
     * @param string $message
     * @return bool
     */
    public function send(string $phone, string $message): bool
    {
        return $this->_engine->send($phone, $message);
    }

    /**
     * @param array $phones
     * @param string $message
     * @return bool
     */
    public function sendToMany(array $phones, string $message): bool
    {
        return $this->_engine->sendToMany($phones, $message);
    }
}