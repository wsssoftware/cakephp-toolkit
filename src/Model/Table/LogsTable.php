<?php
declare(strict_types=1);

namespace Toolkit\Model\Table;

use ArrayObject;
use Authentication\AuthenticationService;
use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Routing\Router;
use Cake\Utility\Text;

/**
 * Logs Model
 *
 * @property Table|\AppCore\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @method \Toolkit\Model\Entity\Log newEmptyEntity()
 * @method \Toolkit\Model\Entity\Log newEntity(array $data, array $options = [])
 * @method \Toolkit\Model\Entity\Log[] newEntities(array $data, array $options = [])
 * @method \Toolkit\Model\Entity\Log get($primaryKey, $options = [])
 * @method \Toolkit\Model\Entity\Log findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Toolkit\Model\Entity\Log patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Toolkit\Model\Entity\Log[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Toolkit\Model\Entity\Log|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Toolkit\Model\Entity\Log saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Toolkit\Model\Entity\Log[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Toolkit\Model\Entity\Log[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Toolkit\Model\Entity\Log[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Toolkit\Model\Entity\Log[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Toolkit\Model\Behavior\TrimBehavior
 */
class LogsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Toolkit.Trim');



        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT',
        ]);

        $schema = $this->getSchema();
        $schema->setColumnType('context', 'json');
        $schema->setColumnType('post_data', 'json');
        $schema->setColumnType('get_data', 'json');
        $this->setSchema($schema);
    }

    /**
     * Write the log to database
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return bool Success
     */
    public function log(mixed $level, string $message, array $context = []): bool {
        $message = trim($message);
        $summary = Text::truncate($message, 255);

        $data = [
            'type' => $level,
            'summary' => $summary,
            'message' => $message,
            'context' => $context,
            'count' => 1,
        ];
        $request = Router::getRequest();
        if (!empty($request)) {
            $userId = null;
            $authentication = $request->getAttribute('authentication', null);
            if (!empty($authentication) && $authentication instanceof AuthenticationService && !empty($authentication->getIdentity())) {
                $userId = $authentication->getIdentity()->getIdentifier();
            }
            $data += [
                'post_data' => $request->getData(),
                'get_data' => $request->getQuery(),
                'user_id' => $userId
            ];
        } else {
            $data += [
                'post_data' => [],
                'get_data' => [],
                'user_id' => null,
            ];
        }
        $log = $this->newEntity($data);

        return (bool)$this->save($log);
    }

    /**
     * @param \Cake\Event\EventInterface $event
     * @param \Toolkit\Model\Entity\Log $entity
     * @param \ArrayObject $options
     * @return void
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        //dd(Router::getRequest());
        $entity['ip'] = env('REMOTE_ADDR');
        $entity['hostname'] = env('HTTP_HOST') ?: gethostname();
        $entity['uri'] = env('REQUEST_URI');
        $entity['refer'] = env('HTTP_REFERER');
        $entity['user_agent'] = env('HTTP_USER_AGENT');

        if (PHP_SAPI === 'cli') {
            if (!$entity['hostname']) {
                $entity['hostname'] = env('SERVER_NAME');
            }
            if (!$entity['hostname']) {
                $user = env('USER');
                $logName = env('LOGNAME');
                if ($user || $logName) {
                    $entity['hostname'] = $user . '@' . $logName;
                }
            }
            if (!$entity['uri']) {
                $type = 'CLI';
                $entity['uri'] = $type . ' ' . str_replace((string)env('PWD'), '', implode(' ', (array)env('argv')));
            }
            if (!$entity['user_agent']) {
                $shell = env('SHELL') ?: 'n/a';
                $entity['user_agent'] = $shell . ' (' . php_uname() . ')';
            }
        }

        $env = getenv('APPLICATION_ENV');
        if ($env) {
            $entity['user_agent'] .= ($entity['user_agent'] ? '' : 'n/a') . ' [' . $env . ']';
        }
    }

    /**
     * Remove duplicates and leave only the newest entry
     * Also stores the new total "number" of this message in the remaining one
     *
     * @param bool $strict
     * @return int
     */
    public function removeDuplicates($strict = false): int {
        $field = $strict ? 'message' : 'summary';

        $query = $this->find();
        $options = [
            'fields' => ['type', $field, 'count' => $query->func()->count('*')],
            'conditions' => [],
            'group' => ['type', $field],
            //'having' => $this->alias . '__count > 0',
            //'order' => ['created' => 'DESC']
        ];
        $logs = $query->find('all', $options)->disableHydration()->toArray();

        $count = 0;
        foreach ($logs as $key => $log) {
            if ($log['count'] <= 1) {
                continue;
            }
            $options = [
                'fields' => ['id'],
                'keyField' => 'id',
                'valueField' => 'id',
                'conditions' => [
                    'type' => $log['type'],
                    $field => $log[$field],
                ],
                'order' => ['created' => 'DESC'],
            ];
            $entries = $this->find('list', $options)->toArray();

            // keep the newest entry
            $keep = array_shift($entries);
            if ($entries) {
                $this->deleteAll(['id IN' => $entries]);
            }
            $count += $this->updateAll(['count = count + ' . count($entries)], ['id' => $keep]);
        }

        return $count;
    }
}
