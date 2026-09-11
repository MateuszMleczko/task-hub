<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class ChangeAvatarIdToNullableOnUsers extends BaseMigration
{
    /**
     * Up Method.
     *
     * @return void
     */
    public function up(): void
    {
        $this->table('users')
            ->changeColumn('avatar_id', 'integer', ['after' => 'password', 'default' => 1, 'null' => true])
            ->update();

        $this->table('users')
            ->addForeignKey('avatar_id', 'avatars', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
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
            ->changeColumn('avatar_id', 'integer', ['after' => 'password', 'default' => 1, 'null' => false])
            ->update();
    }
}
