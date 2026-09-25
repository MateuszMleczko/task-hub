<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddUserForeignKeysWithCascade extends BaseMigration
{
    /**
     * Change Method.
     *
     * Deleting a user removes their tasks and password reset tokens with them, so an
     * account deleted on request (GDPR art. 17) leaves no personal data behind.
     *
     * @return void
     */
    public function change(): void
    {
        $this->table('tasks')
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->update();

        $this->table('restore_password_tokens')
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->update();
    }
}
