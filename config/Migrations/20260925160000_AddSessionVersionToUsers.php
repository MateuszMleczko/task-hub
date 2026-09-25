<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddSessionVersionToUsers extends BaseMigration
{
    /**
     * Change Method.
     *
     * Bumped whenever the password changes. Every session remembers the version it
     * was created with, and one that no longer matches is rejected - which signs
     * the user out on all devices at once.
     *
     * @return void
     */
    public function change(): void
    {
        $this->table('users')
            ->addColumn('session_version', 'integer', [
                'after' => 'privacy_policy_accepted_at',
                'default' => 0,
                'null' => false,
            ])
            ->update();
    }
}
