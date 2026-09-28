<?php
declare(strict_types=1);

namespace App\Authenticator;

use Authentication\Authenticator\FormAuthenticator;
use Authentication\Authenticator\Result;
use Authentication\Authenticator\ResultInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Form authenticator that refuses users who have not confirmed their email address.
 *
 */
class VerifiedFormAuthenticator extends FormAuthenticator
{
    public const FAILURE_EMAIL_NOT_VERIFIED = 'FAILURE_EMAIL_NOT_VERIFIED';

    /**
     * @inheritDoc
     */
    public function authenticate(ServerRequestInterface $request): ResultInterface
    {
        $result = parent::authenticate($request);

        if ($result->isValid() && $result->getData()['email_verified_at'] === null) {
            return new Result(null, self::FAILURE_EMAIL_NOT_VERIFIED);
        }

        return $result;
    }
}
