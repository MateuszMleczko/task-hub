<?php
declare(strict_types=1);

use Migrations\BaseMigration;

/**
 * Every user has an avatar: avatar_id becomes NOT NULL without a default and an avatar
 * that is still in use can no longer be deleted (ON DELETE RESTRICT instead of SET NULL).
 */
class MakeAvatarIdRequiredOnUsers extends BaseMigration
{
    /**
     * Up Method.
     *
     * @return void
     */
    public function up(): void
    {
        $this->table('users')
            ->dropForeignKey('avatar_id')
            ->update();

        $this->table('users')
            ->changeColumn('avatar_id', 'integer', ['after' => 'password', 'default' => null, 'null' => false])
            ->addForeignKey('avatar_id', 'avatars', 'id', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])
            ->update();
    }

    /**
     * Down Method.
     *
     * @return void
     */
    public function down(): void
    {
        $this->table('users')
            ->dropForeignKey('avatar_id')
            ->update();

        $this->table('users')
            ->changeColumn('avatar_id', 'integer', ['after' => 'password', 'default' => 1, 'null' => true])
            ->addForeignKey('avatar_id', 'avatars', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
            ->update();
    }
}
