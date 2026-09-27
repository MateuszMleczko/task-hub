<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddPrivacyPolicyAcceptedAtToUsers extends BaseMigration
{
    /**
     * Change Method.
     *
     * Moment the user accepted the privacy policy at registration. Nullable, because
     * accounts created before the policy existed never accepted it.
     *
     * @return void
     */
    public function change(): void
    {
        $this->table('users')
            ->addColumn('privacy_policy_accepted_at', 'datetime', [
                'after' => 'avatar_id',
                'default' => null,
                'null' => true,
            ])
            ->update();
    }
}
