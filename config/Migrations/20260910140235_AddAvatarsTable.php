<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddAvatarsTable extends BaseMigration
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
        $this->table('avatars')
            ->addColumn('user_id', 'integer', ['default' => null, 'null' => true])
            ->addColumn('is_default', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('storage_key', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
            ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->create();
    }
}
