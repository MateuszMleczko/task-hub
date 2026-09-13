<?php

declare(strict_types=1);

namespace App\Enum;

Enum TaskPriorityEnum: string
{
    const LOW = 1;
    const MEDIUM = 2;
    const HIGH = 3;

    public static function getStatuses(): array
    {
        return [
            self::LOW => __d('default', 'Low'),
            self::MEDIUM => __d('default', 'Medium'),
            self::HIGH => __d('default', 'High'),
        ];
    }

}
