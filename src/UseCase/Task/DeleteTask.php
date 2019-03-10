<?php

namespace App\UseCase\Task;

use App\Repository\TaskRepository;
use App\UseCase\AbstractTaskUseCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class DeleteTask extends AbstractTaskUseCase
{
    public function __construct(TaskRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @throws \App\Exception\Task\TaskNotFoundException
     */
    public function execute(int $taskId)
    {
        $task = $this->taskRepository->findById($taskId);

        $this->taskRepository->delete($task);
    }
}
