<?php

namespace App\Entity\Task;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
final class TaskFilter
{
    public const STARRED     = 'starred';

    public const COMPLETED   = 'completed';

    public const IN_PROGRESS = 'in-progress';

    static public function getTaskFilters(): array
    {
        return [self::STARRED, self::COMPLETED, self::IN_PROGRESS];
    }
}
