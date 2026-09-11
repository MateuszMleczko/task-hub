<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddAvatarIdColumnToUsers extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/5/guides/writing-migrations/migration-methods.html#the-change-method
     *
     * @return void
     */
    public function change(): void
    {
        $this->table('users')
            ->addColumn('avatar_id', 'integer', ['after' => 'password', 'default' => 1, 'null' => false])
            ->update();
    }
}
