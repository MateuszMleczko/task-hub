<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Utility\PasswordValidator;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\User> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\User> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    public const NAME_MIN_LENGTH = 2;
    public const NAME_MAX_LENGTH = 50;
    public const EMAIL_MAX_LENGTH = 255;

    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('email');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Avatars', [
            'foreignKey' => 'avatar_id',
            'joinType' => 'LEFT',
        ]);
        $this->hasMany('Tasks', [
            'foreignKey' => 'user_id',
            'dependent' => true,
        ]);
        $this->hasMany('RestorePasswordTokens', [
            'foreignKey' => 'user_id',
            'dependent' => true,
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        // One message per field: the first rule that fails. It also keeps a later
        // rule from ever receiving a value an earlier one rejected, e.g. an array.
        $validator->setStopOnFailure();

        $validator
            ->scalar('name', __('Please enter your name.'))
            ->requirePresence('name', 'create', __('Please enter your name.'))
            ->notEmptyString('name', __('Please enter your name.'))
            ->minLength(
                'name',
                self::NAME_MIN_LENGTH,
                __('Name must be at least {0} characters long.', self::NAME_MIN_LENGTH),
            )
            ->maxLength(
                'name',
                self::NAME_MAX_LENGTH,
                __('Name can be at most {0} characters long.', self::NAME_MAX_LENGTH),
            );

        $validator
            ->scalar('email', __('Please enter a valid email address.'))
            ->requirePresence('email', 'create', __('Please enter your email address.'))
            ->notEmptyString('email', __('Please enter your email address.'))
            ->maxLength(
                'email',
                self::EMAIL_MAX_LENGTH,
                __('Email address can be at most {0} characters long.', self::EMAIL_MAX_LENGTH),
            )
            ->email('email', false, __('Please enter a valid email address.'))
            ->add('email', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => __('An account with this email address already exists.'),
            ]);

        $validator
            ->scalar('password', __('Please enter a password.'))
            ->requirePresence('password', 'create', __('Please enter a password.'))
            ->notEmptyString('password', __('Please enter a password.'))
            ->add('password', 'strength', [
                'rule' => fn(string $value): string|bool => PasswordValidator::strengthError($value) ?? true,
            ]);

        $validator
            ->scalar('confirm_password', __('Please confirm your password.'))
            ->requirePresence('confirm_password', 'create', __('Please confirm your password.'))
            ->notEmptyString('confirm_password', __('Please confirm your password.'))
            ->sameAs('confirm_password', 'password', __('Passwords do not match.'));

        $validator
            ->integer('avatar_id')
            ->requirePresence('avatar_id', 'create')
            ->notEmptyString('avatar_id', __('Please choose an avatar.'));

        $validator
            ->requirePresence('privacy_policy', 'create', __('You must accept the privacy policy.'))
            ->equals('privacy_policy', '1', __('You must accept the privacy policy.'));

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        $rules->add($rules->existsIn(['avatar_id'], 'Avatars'), [
            'errorField' => 'avatar_id',
            'message' => __('Selected avatar does not exist.'),
        ]);

        return $rules;
    }

    /**
     * Normalizes the name and email before validation: trims both ends and collapses
     * repeated whitespace inside the name
     *
     * @param \Cake\Event\EventInterface $event
     * @param \ArrayObject $data
     * @param \ArrayObject $options
     * @return void
     */
    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options): void
    {
        if (isset($data['name']) && is_string($data['name'])) {
            $data['name'] = trim((string)preg_replace('/\s+/u', ' ', $data['name']));
        }

        if (isset($data['email']) && is_string($data['email'])) {
            $data['email'] = trim($data['email']);
        }
    }

    /**
     * Bumps `session_version` whenever an existing user's password changes, which
     * signs them out on every device, see \App\Authenticator\VersionedSessionAuthenticator.
     *
     * @param \Cake\Event\EventInterface $event The beforeSave event.
     * @param \App\Model\Entity\User $entity The user being saved.
     * @param \ArrayObject $options Save options.
     * @return void
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        if (!$entity->isNew() && $entity->isDirty('password')) {
            $entity->set('session_version', (int)$entity->get('session_version') + 1);
        }
    }
}
