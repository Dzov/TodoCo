<?php

namespace App\Tests\Doubles\Repository\Task;

use App\Entity\Task\Task;
use App\Exception\Task\TaskNotFoundException;
use App\Repository\Task\TaskRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class InMemoryTaskRepository extends TaskRepository
{
    /**
     * @var Task[]
     */
    public static $tasks;

    /**
     * @param Task[] $tasks
     */
    public function __construct(array $tasks)
    {
        self::$tasks = $tasks;
    }

    public function insert(Task $task)
    {
        self::$tasks = [$task];
    }

    public function findAll(array $filters = [], array $sorts = [])
    {
        return self::$tasks;
    }

    public function findById(int $id)
    {
        if (!isset(self::$tasks[$id])) {
            throw new TaskNotFoundException();
        }

        return self::$tasks[$id];
    }

    public function delete(Task $task)
    {
        unset(self::$tasks[$task->getId()]);
    }

    public function update(Task $task)
    {
        self::$tasks[$task->getId()] = $task;
    }
}
