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
            $task = $this->getTask($taskId);
            $currentUser = $this->getUser($userId);
            $taskAuthor = $this->getTaskAuthor($task);

            if ($this->currentUserIsAuthor($task, $currentUser)
                || ($taskAuthor->isAnonymousUser() && $currentUser->isAdmin())) {
                return true;
            }
        } catch (UserNotFoundException $e) {
            return false;
        }

        return false;
    }

    /**
     * @throws TaskNotFoundException
     */
    protected function getTask(int $taskId): Task
    {
        return $this->taskRepository->findById($taskId);
    }

    /**
     * @throws UserNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function getUser(int $userId): User
    {
        return $this->userRepository->findById($userId);
    }

    /**
     * @throws UserNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function getTaskAuthor(Task $task): User
    {
        return $this->userRepository->findById($task->getAuthorId());
    }

    private function currentUserIsAuthor(Task $task, User $currentUser): bool
    {
        return $task->getAuthorId() === $currentUser->getId();
    }
}
