<?php

namespace App\Tests\Doubles\Repository\Task;

use App\Entity\Task\Task;
use App\Exception\Task\TaskNotFoundException;
use App\Repository\TaskRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class InMemoryTaskRepository extends TaskRepository
{
    /**
     * @var Task[]
     */
    public static $result;

    /**
     * @param Task[] $result
     */
    public function __construct(array $result)
    {
        self::$result = $result;
    }

    public function insert(Task $task)
    {
        self::$result = [$task];
    }

    public function findAll(array $filters = [], array $sort = [])
    {
        return self::$result;
    }

    public function findById(int $id)
    {
        if (!isset(self::$result[$id])) {
            throw new TaskNotFoundException();
        }

        return self::$result[$id];
    }

    public function delete(Task $task)
    {
        unset(self::$result[$task->getId()]);
    }

    public function update(Task $task)
    {
        self::$result[$task->getId()] = $task;
    }
}
