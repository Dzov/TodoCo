<?php

namespace App\UseCase\Task;

use App\Entity\Task\Task;
use App\Repository\Task\TaskRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ToggleTaskPriority extends AbstractTaskUseCase
{
    /**
     * @throws \App\Exception\Task\TaskNotFoundException
     */
    public function execute(int $taskId)
    {
        /** @var Task $task */
        $task = $this->taskRepository->findById($taskId);
        $task->togglePriority();
        $this->taskRepository->update($task);

        return $task;
    }
}
