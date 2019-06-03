<?php

namespace App\UseCase\Task;

use App\Entity\Task\Task;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ToggleTaskStatus extends AbstractTaskUseCase
{
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
