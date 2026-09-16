<?php

declare(strict_types=1);

namespace App\Enum;

Enum TaskPriorityEnum: string
{
    const LOW = 1;
    const MEDIUM = 2;
    const HIGH = 3;

    public static function getPriorities(): array
    {
        return [
            self::LOW => __d('default', 'Low'),
            self::MEDIUM => __d('default', 'Medium'),
            self::HIGH => __d('default', 'High'),
        ];
    }

    /**
     * Slug used as CSS modifier (e.g. task-form__tile-input--high) for each priority.
     */
    public static function getAccents(): array
    {
        return [
            self::LOW => 'low',
            self::MEDIUM => 'medium',
            self::HIGH => 'high',
        ];
    }

}
