<?php
declare(strict_types=1);

namespace App\Mailer;

use Cake\Core\Configure;
use Cake\Mailer\Mailer;

class DefaultMailer extends Mailer
{
    private string $fromEmail;

    public function __construct($config = null)
    {
        parent::__construct($config);

        $this->fromEmail = Configure::read('emails.mailerFromEmail');
    }

    public function forgotPassword(string $email, string $url): void
    {
        $this
            ->setTo(trim($email))
            ->setFrom($this->fromEmail)
            ->setSubject($this->subject(__d('email', 'Password reset')))
            ->setEmailFormat('html')
            ->setViewVars([
                'url' => $url,
            ])
            ->viewBuilder()
            ->setTemplate('forgot_password');
    }

    private function subject(string $title): string
    {
        return 'TaskHub' . ' - ' . $title;
    }
}
