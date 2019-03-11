<?php

namespace App\UseCase\Task;

use App\Entity\Task;
use App\Form\Task\Model\TaskModel;
use App\Repository\TaskRepository;
use App\UseCase\AbstractTaskUseCase;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class EditTask extends AbstractTaskUseCase
{
    public function __construct(TaskRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @throws \App\Exception\Task\TaskNotFoundException
     */
    public function execute(TaskModel $model)
    {
        $task = $this->taskRepository->findById($model->getId());

        $this->updateProperties($model, $task);

        $this->taskRepository->update($task);
    }

    private function updateProperties(TaskModel $model, Task $task)
    {
        $task->setContent($model->getContent());
        $task->setTitle($model->getTitle());
    }
}
