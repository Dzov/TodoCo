<?php

namespace App\Security\VoterService;

use App\Entity\Task\Task;
use App\Entity\User\User;
use App\Exception\Task\TaskNotFoundException;
use App\Repository\TaskRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CanUserDeleteTaskVoterService
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(TaskRepository $repository)
    {
        $this->taskRepository = $repository;
    }

    public function canUserDeleteTask(User $user, int $taskId): bool
    {
        try {
            /** @var Task $task */
            $task = $this->taskRepository->findById($taskId);
            if ($task->getAuthorId() === $user->getId()) {
                return true;
            }
        } catch (TaskNotFoundException $e) {
        }

        return false;
    }
}
