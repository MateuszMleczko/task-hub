<?php
declare(strict_types=1);

namespace App\Utility;

use Random\RandomException;

/**
 * Generates cryptographically secure, human-friendly random tokens.
 */
class TokensGenerator
{
    private const CHARACTERS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

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
