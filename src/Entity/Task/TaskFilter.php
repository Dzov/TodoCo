<?php

namespace App\Entity\Task;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
final class TaskFilter
{
    const STARRED     = 'starred';

    const COMPLETED   = 'completed';

    const IN_PROGRESS = 'in-progress';

    static public function getTaskFilters(): array
    {
        $reflectionClass = new \ReflectionClass(self::class);

        return $reflectionClass->getConstants();
    }
}
