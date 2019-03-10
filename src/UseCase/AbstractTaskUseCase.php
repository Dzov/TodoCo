<?php

namespace App\UseCase;

use App\Repository\TaskRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
abstract class AbstractTaskUseCase
{
    /**
     * @var TaskRepository
     */
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
}
