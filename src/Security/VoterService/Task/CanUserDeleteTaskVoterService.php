<?php

namespace App\Security\VoterService\Task;

use App\Entity\Task\Task;
use App\Entity\User\User;
use App\Exception\Task\TaskNotFoundException;
use App\Exception\User\UserNotFoundException;
use App\Repository\Task\TaskRepository;
use App\Repository\User\UserRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CanUserDeleteTaskVoterService
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(TaskRepository $repository, UserRepository $userRepository)
    {
        $this->taskRepository = $repository;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws TaskNotFoundException
     */
    public function canUserDeleteTask(int $userId, int $taskId): bool
    {
        try {
            /** @var Task $task */
            $task = $this->getTask($taskId);
            /** @var User $user */
            $user = $this->getUser($userId);
            /** @var User $taskAuthor */
            $taskAuthor = $this->getAuthor($task);

            if ($task->getAuthorId() === $user->getId()) {
                return true;
            }

            if ($taskAuthor->isAnonymousUser() && $user->isAdmin()) {
                return true;
            }
        } catch (UserNotFoundException $e) {
        }

        return false;
    }

    /**
     * @throws TaskNotFoundException
     */
    protected function getTask(int $taskId)
    {
        return $this->taskRepository->findById($taskId);
    }

    /**
     * @throws UserNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function getUser(int $userId)
    {
        return $this->userRepository->findById($userId);
    }

    /**
     * @throws UserNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function getAuthor(Task $task)
    {
        return $this->userRepository->findById($task->getAuthorId());
    }
}
