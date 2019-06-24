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
        $task = $this->getTask($taskId);
        $task->toggleStatus();
        $this->update($task);

        return $task;
    }

    /**
     * @throws \App\Exception\Task\TaskNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function getTask(int $taskId): Task
    {
        return $this->taskRepository->findById($taskId);
    }

    private function update($task): void
    {
        $this->taskRepository->update($task);
    }
}
