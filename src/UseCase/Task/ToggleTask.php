<?php

namespace App\UseCase\Task;

use App\Repository\TaskRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ToggleTask extends AbstractTaskUseCase
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
        $task->setIsDone(!$task->isDone());
        $this->taskRepository->update($task);

        return $task;
    }
}
