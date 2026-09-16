<?php

declare(strict_types=1);

namespace App\Enum;

Enum TaskStatusEnum: string
{
    const TO_DO = 1;
    const IN_PROGRESS = 2;
    const BLOCKED = 3;
    const DONE = 4;

    public static function getStatuses(): array
    {
        return [
            self::TO_DO => __d('default', 'To Do'),
            self::IN_PROGRESS => __d('default', 'In Progress'),
            self::BLOCKED => __d('default', 'Blocked'),
            self::DONE => __d('default', 'Done')
        ];
    }

    /**
     * Slug used as CSS modifier (e.g. tasks__column--todo) for each status.
     */
    public static function getAccents(): array
    {
        return [
            self::TO_DO => 'todo',
            self::IN_PROGRESS => 'progress',
            self::BLOCKED => 'blocked',
            self::DONE => 'done',
        ];
    }

}
