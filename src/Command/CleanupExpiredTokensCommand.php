<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\I18n\DateTime;

/**
 * Deletes password reset tokens past their expiry date.
 *
 * A token otherwise stays in the database until its owner requests another one
 * or resets the password, which the privacy policy does not allow for. Meant to
 * run from cron, e.g. hourly: `bin/cake cleanup_expired_tokens`.
 */
class CleanupExpiredTokensCommand extends Command
{
    /**
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return int
     */
    public function execute(Arguments $args, ConsoleIo $io): int
    {
        $deleted = $this->fetchTable('RestorePasswordTokens')
            ->deleteAll(['expires_at <' => new DateTime()]);

        $io->out(sprintf('Deleted %d expired password reset token(s).', $deleted));

        return static::CODE_SUCCESS;
    }
}
