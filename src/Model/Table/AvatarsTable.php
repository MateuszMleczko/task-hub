<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Avatars Model
 *
 * @method \App\Model\Entity\Avatar newEmptyEntity()
 * @method \App\Model\Entity\Avatar newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Avatar get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Avatar patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Avatar|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AvatarsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('avatars');
        $this->setDisplayField('storage_key');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        // TAS-25 dopisze tu: $this->belongsTo('Users');
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
            ->scalar('storage_key')
            ->maxLength('storage_key', 255)
            ->notEmptyString('storage_key');

        $validator
            ->boolean('is_default')
            ->notEmptyString('is_default');

        return $validator;
    }
}
