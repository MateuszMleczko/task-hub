<?php
declare(strict_types=1);

namespace App\Utility;

/**
 * Validates a new password together with its confirmation.
 *
 * Shared by register, reset password and change password so the rules live in one place.
 */
class PasswordValidator
{
    private const MIN_LENGTH = 8;

    /**
     * Returns the first validation error message, or null when the password is acceptable.
     *
     * @param string|null $password New password.
     * @param string|null $confirmPassword Confirmation of the new password.
     * @return string|null
     */
    public static function validate(?string $password, ?string $confirmPassword): ?string
    {
        if (empty($password) || empty($confirmPassword)) {
            return __('Password and confirm password fields cannot be empty.');
        }

        if ($password !== $confirmPassword) {
            return __('Passwords do not match.');
        }

        if (mb_strlen($password) < self::MIN_LENGTH) {
            return __('Password must be at least {0} characters long.', self::MIN_LENGTH);
        }

        if (!preg_match('/[A-Z]/', $password)) {
            return __('Password must contain at least one uppercase letter.');
        }

        if (!preg_match('/[0-9]/', $password)) {
            return __('Password must contain at least one number.');
        }

        return null;
    }
}
