<?php

namespace App\UseCase\Task;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class GetTask extends AbstractTaskUseCase
{
    /**
     * @throws \App\Exception\Task\TaskNotFoundException
     */
    public function execute(int $taskId)
    {
        return $this->taskRepository->findById($taskId);
    }
}
