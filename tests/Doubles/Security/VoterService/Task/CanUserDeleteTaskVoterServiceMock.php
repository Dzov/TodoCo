<?php

namespace App\Tests\Doubles\Security\VoterService\Task;

use App\Entity\User\User;
use App\Security\VoterService\Task\CanUserDeleteTaskVoterService;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CanUserDeleteTaskVoterServiceMock extends CanUserDeleteTaskVoterService
{
    public static $canUserDeleteTask = false;

    public function canUserDeleteTask(User $user, int $taskId): bool
    {
        return self::$canUserDeleteTask;
    }
}
