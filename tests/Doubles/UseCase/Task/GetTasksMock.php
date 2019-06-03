<?php

namespace App\Tests\Doubles\UseCase\Task;

use App\UseCase\Task\GetTasks;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetTasksMock extends GetTasks
{
    public static $tasks = [];

    public function __construct(array $tasks)
    {
        self::$tasks = $tasks;
    }

    public function execute(array $filters = [])
    {
        return self::$tasks;
    }
}
