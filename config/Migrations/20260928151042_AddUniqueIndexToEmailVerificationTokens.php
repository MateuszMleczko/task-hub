<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddUniqueIndexToEmailVerificationTokens extends BaseMigration
{
    /**
     * Change Method.
     *
     * Tokens are looked up by their hash when a confirmation link is opened, so the
     * column is indexed, and the unique constraint guarantees the lookup can never
     * match more than one user.
     *
     * @return void
     */
    public function change(): void
    {
        $this->table('email_verification_tokens')
            ->addIndex(['token'], [
                'unique' => true,
                'name' => 'idx_email_verification_tokens_token',
            ])
            ->update();
    }
}
