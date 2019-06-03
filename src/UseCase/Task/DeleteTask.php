<?php

namespace App\UseCase\Task;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class DeleteTask extends AbstractTaskUseCase
{
    /**
     * @throws \App\Exception\Task\TaskNotFoundException
     */
    public function execute(int $taskId)
    {
        $task = $this->taskRepository->findById($taskId);

        $this->taskRepository->delete($task);
    }
}
