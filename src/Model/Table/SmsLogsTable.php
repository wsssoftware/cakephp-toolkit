<?php
declare(strict_types=1);

namespace Toolkit\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SmsLogs Model
 *
 * @method \Toolkit\Model\Entity\SmsLog newEmptyEntity()
 * @method \Toolkit\Model\Entity\SmsLog newEntity(array $data, array $options = [])
 * @method \Toolkit\Model\Entity\SmsLog[] newEntities(array $data, array $options = [])
 * @method \Toolkit\Model\Entity\SmsLog get($primaryKey, $options = [])
 * @method \Toolkit\Model\Entity\SmsLog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Toolkit\Model\Entity\SmsLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Toolkit\Model\Entity\SmsLog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Toolkit\Model\Entity\SmsLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Toolkit\Model\Entity\SmsLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Toolkit\Model\Entity\SmsLog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Toolkit\Model\Entity\SmsLog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Toolkit\Model\Entity\SmsLog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Toolkit\Model\Entity\SmsLog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SmsLogsTable extends Table
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

        $this->setTable('sms_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Toolkit.Trim');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 15)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');

        $validator
            ->scalar('message')
            ->maxLength('message', 200)
            ->requirePresence('message', 'create')
            ->notEmptyString('message');

        return $validator;
    }

    /**
     * @param string $phone
     * @param string $message
     * @return bool
     */
    public function log(string $phone, string $message): bool
    {
        return (bool)$this->save($this->newEntity(compact('phone', 'message')));
    }
}
