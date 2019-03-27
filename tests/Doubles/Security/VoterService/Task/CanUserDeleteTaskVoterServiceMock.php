<?php

namespace App\Tests\Doubles\Security\VoterService\Task;

use App\Security\VoterService\Task\CanUserDeleteTaskVoterService;
use App\Tests\Doubles\Repository\Task\InMemoryTaskRepository;
use App\Tests\Doubles\Repository\User\InMemoryUserRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CanUserDeleteTaskVoterServiceMock extends CanUserDeleteTaskVoterService
{
    public static $canUserDeleteTask = false;

    public function __construct()
    {
        parent::__construct(new InMemoryTaskRepository([]), new InMemoryUserRepository([]));
    }

    public function canUserDeleteTask(int $userId, int $taskId): bool
    {
        return self::$canUserDeleteTask;
    }
}
