<?php

namespace App\UseCase\Task;

use App\Entity\Task;
use App\Repository\TaskRepository;
use App\UseCase\AbstractTaskUseCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CreateTask extends AbstractTaskUseCase
{
    public function __construct(TaskRepository $repository)
    {
        parent::__construct($repository);
    }

    public function execute(Task $task)
    {
        $this->taskRepository->insert($task);
    }
}
