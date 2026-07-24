<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddPasswordColumnToUsersTable extends BaseMigration
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
        $table = $this->table('users');

        if (!$table->hasColumn('password')) {
            $table->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
                'after' => 'email'
            ]);
            $table->update();
        }
        if (!$table->hasColumn('name')) {
            $table->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
                'after' => 'id'
            ]);
            $table->update();
        }
    }
}
