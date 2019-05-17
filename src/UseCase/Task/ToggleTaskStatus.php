<?php

namespace App\UseCase\Task;

use App\Entity\Task\Task;
use App\Repository\TaskRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ToggleTaskStatus extends AbstractTaskUseCase
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
        /** @var Task $task */
        $task = $this->taskRepository->findById($taskId);
        $task->toggleStatus();
        $this->taskRepository->update($task);

        return $task;
    }
}
