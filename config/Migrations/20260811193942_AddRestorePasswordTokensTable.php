<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddRestorePasswordTokensTable extends BaseMigration
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
        if (!$this->table('restore_password_tokens')->exists()) {
            $this->table('restore_password_tokens')
                ->addColumn('user_id', 'integer', ['null' => false])
                ->addColumn('token', 'string', ['limit' => 64, 'null' => false])
                ->addColumn('expires_at', 'datetime', ['null' => false])
                ->create();
        }
    }
}
