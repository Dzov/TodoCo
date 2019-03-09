<?php

namespace App\Tests\Doubles\Task\Repository;

use App\Entity\Task;
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

    public function findAll(array $filters = [], array $sort = [])
    {
        return self::$result;
    }
}
