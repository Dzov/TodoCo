<?php

namespace App\UseCase\Task;

use App\Entity\Task;
use App\Entity\User;
use App\Model\Task\TaskModel;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CreateTask extends AbstractTaskUseCase
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(TaskRepository $repository, UserRepository $userRepository)
    {
        parent::__construct($repository);
        $this->userRepository = $userRepository;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \App\Exception\User\UserNotFoundException
     */
    public function execute(TaskModel $model, int $userId)
    {
        $user = $this->getUser($userId);
        $task = $this->populateTask($model, $user);
        $this->taskRepository->insert($task);
    }

    private function populateTask(TaskModel $model, User $user): Task
    {
        $task = new Task();
        $task->setContent($model->getContent());
        $task->setCreatedAt($model->getCreatedAt());
        $task->setIsDone($model->isDone());
        $task->setTitle($model->getTitle());
        $task->setAuthor($user);

        return $task;
    }

    /**
     * @throws \App\Exception\User\UserNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function getUser(int $userId): User
    {
        return $this->userRepository->findById($userId);
    }
}
