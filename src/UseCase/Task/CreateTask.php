<?php

namespace App\UseCase\Task;

use App\Entity\Task;
use App\Model\Task\TaskModel;
use App\Repository\TaskRepository;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CreateTask extends AbstractTaskUseCase
{
    public function __construct(TaskRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function execute(TaskModel $model)
    {
        $task = $this->populateTask($model);
        $this->taskRepository->insert($task);
    }

    private function populateTask(TaskModel $model): Task
    {
        $task = new Task();
        $task->setContent($model->getContent());
        $task->setCreatedAt($model->getCreatedAt());
        $task->setIsDone($model->isDone());
        $task->setTitle($model->getTitle());

        return $task;
    }
}
