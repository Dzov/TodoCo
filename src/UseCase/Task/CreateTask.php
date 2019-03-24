<?php

namespace App\UseCase\Task;

use App\Entity\Task\Task;
use App\Entity\User\User;
use App\Model\Task\TaskModel;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;

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
    public function execute(TaskModel $model)
    {
        $author = $this->getUser($model->getAuthorId());
        $task = $this->populateTask($model, $author);
        $this->taskRepository->insert($task);
    }

    private function populateTask(TaskModel $model, UserInterface $author): Task
    {
        $task = new Task();
        $task->setContent($model->getContent());
        $task->setCreatedAt($model->getCreatedAt());
        $task->setIsDone($model->isDone());
        $task->setTitle($model->getTitle());
        $task->setAuthor($author);

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
