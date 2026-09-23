<?php
declare(strict_types=1);

namespace App\Utility;

use Cake\Utility\Security;
use Random\RandomException;

/**
 * Generates cryptographically secure, human-friendly random tokens.
 */
class TokensGenerator
{
    private const CHARACTERS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * @param string $token
     * @return string
     */
    public static function hash(string $token): string
    {
        return hash_hmac('sha256', $token, Security::getSalt());
    }

    /**
     * @throws RandomException
     */
    public static function generateRandomString(int $length = 64): string
    {
        $max = strlen(self::CHARACTERS) - 1;
        $token = '';

        for ($i = 0; $i < $length; $i++) {
            $token .= self::CHARACTERS[random_int(0, $max)];
        }

        return $token;
    }
}
