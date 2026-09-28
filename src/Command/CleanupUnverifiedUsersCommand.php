<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\I18n\DateTime;

/**
 * Deletes accounts whose email address was never confirmed.
 *
 * Frees the address for its real owner and removes personal data nobody
 * verified. Email verification tokens go with the user (ON DELETE CASCADE).
 * Meant to run from cron, e.g. daily: `bin/cake cleanup_unverified_users`.
 */
class CleanupUnverifiedUsersCommand extends Command
{
    private const UNVERIFIED_ACCOUNT_LIFETIME_DAYS = 7;

    /**
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return int
     */
    public function execute(Arguments $args, ConsoleIo $io): int
    {
        $deleted = $this->fetchTable('Users')
            ->deleteAll([
                'email_verified_at IS' => null,
                'created <' => DateTime::now()->subDays(self::UNVERIFIED_ACCOUNT_LIFETIME_DAYS),
            ]);

        $io->out(sprintf('Deleted %d unverified user(s).', $deleted));

        return static::CODE_SUCCESS;
    }
}
