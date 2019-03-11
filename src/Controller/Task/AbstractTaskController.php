<?php

namespace App\Controller\Task;

use App\Entity\Task;
use App\Form\Task\Model\TaskModel;
use App\Form\Task\TaskType;
use App\UseCase\Task\GetTask;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class AbstractTaskController extends AbstractController
{
    protected function getTask(int $taskId, GetTask $getTask)
    {
        return $getTask->execute($taskId);
    }

    protected function buildForm(TaskModel $model): FormInterface
    {
        return $this->createForm(TaskType::class, $model);
    }

    protected function buildModel(Task $task): TaskModel
    {
        $model = new TaskModel();
        $model->setContent($task->getContent());
        $model->setCreatedAt($task->getCreatedAt());
        $model->setId($task->getId());
        $model->setIsDone($task->isDone());
        $model->setTitle($task->getTitle());

        return $model;
    }
}
