<?php

namespace App\UseCase\Task;

use App\Repository\TaskRepository;
use App\UseCase\AbstractTaskUseCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class UpdateTask extends AbstractTaskUseCase
{
    public function __construct(TaskRepository $repository)
    {
        parent::__construct($repository);
    }

    public function updateTask(int $taskId)
    {

    }
}
