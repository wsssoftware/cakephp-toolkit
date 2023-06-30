<?php
declare(strict_types=1);


namespace Toolkit\Log\Engine;


use AppCore\Model\Table\LogsTable;
use Cake\Log\Engine\BaseLog;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;

class DatabaseLog extends BaseLog
{

    /**
     * @var \Cake\ORM\Table|\Toolkit\Model\Table\LogsTable
     */
    private Table|\Toolkit\Model\Table\LogsTable $Logs;

    /**
     * @var array
     */
    protected static array $_context = [];

    /**
     * DatabaseLog constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = []) {
        parent::__construct($config);
        $this->Logs = TableRegistry::getTableLocator()->get('Toolkit.Logs');
    }

    /**
     * @return void
     */
    public static function resetContext(): void
    {
        self::$_context = [];
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public static function addContext(string $key, mixed $value): void
    {
        self::$_context = Hash::insert(self::$_context, $key, $value);
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return bool|void
     */
    public function log($level, $message, array $context = [])
    {
        $context = array_merge(self::$_context, $context);
        if ($this->getConfig('type')) {
            $level = $this->getConfig('type');
        } elseif ($this->getConfig('file')) {
            $level = $this->getConfig('file');
        }

        return $this->Logs->log($level, $message, $context);
    }
}