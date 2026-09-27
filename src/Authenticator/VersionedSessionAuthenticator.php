<?php
declare(strict_types=1);

namespace App\Authenticator;

use Authentication\Authenticator\PrimaryKeySessionAuthenticator;
use Authentication\Authenticator\Result;
use Authentication\Authenticator\ResultInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Session authenticator that can sign a user out on every device at once.
 *
 * Next to the user id, the session stores the user's `session_version` from
 * the moment of login. Bumping that column in the database (UsersTable does it
 * on every password change) invalidates every session created before, because
 * their stored version no longer matches.
 */
class VersionedSessionAuthenticator extends PrimaryKeySessionAuthenticator
{
    /**
     * Default config for this object.
     *
     * - `versionSessionKey` Session key holding the session version.
     * - `versionField` Users column holding the current version.
     *
     * @var array<string, mixed>
     */
    protected array $_defaultConfig = [
        'fields' => [],
        'sessionKey' => 'Auth',
        'impersonateSessionKey' => 'AuthImpersonate',
        'identityAttribute' => 'identity',
        'identifierKey' => 'key',
        'idField' => 'id',
        'versionSessionKey' => 'AuthVersion',
        'versionField' => 'session_version',
    ];

    /**
     * @inheritDoc
     */
    public function authenticate(ServerRequestInterface $request): ResultInterface
    {
        $result = parent::authenticate($request);
        if (!$result->isValid()) {
            return $result;
        }

        $session = $request->getAttribute('session');
        $sessionVersion = $session->read($this->getConfig('versionSessionKey'));
        $userVersion = $result->getData()[$this->getConfig('versionField')] ?? null;

        if ($sessionVersion === null || (int)$sessionVersion !== (int)$userVersion) {
            $session->delete($this->getConfig('sessionKey'));
            $session->delete($this->getConfig('versionSessionKey'));

            return new Result(null, Result::FAILURE_IDENTITY_NOT_FOUND);
        }

        return $result;
    }

    /**
     * Written every time, so `AuthenticationComponent::setIdentity()` after a
     * password change moves the current session to the new version.
     *
     * @inheritDoc
     */
    public function persistIdentity(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $identity,
    ): array {
        $result = parent::persistIdentity($request, $response, $identity);

        $session = $request->getAttribute('session');
        $session->write(
            $this->getConfig('versionSessionKey'),
            (int)($identity[$this->getConfig('versionField')] ?? 0),
        );

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function clearIdentity(ServerRequestInterface $request, ResponseInterface $response): array
    {
        $session = $request->getAttribute('session');
        $session->delete($this->getConfig('versionSessionKey'));

        return parent::clearIdentity($request, $response);
    }
}
