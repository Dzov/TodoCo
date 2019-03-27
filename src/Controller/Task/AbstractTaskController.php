<?php

namespace App\Controller\Task;

use App\Form\Task\TaskType;
use App\Model\Task\TaskModel;
use App\UseCase\Task\GetTask;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class AbstractTaskController extends AbstractController
{
    protected function getTask(int $taskId, GetTask $getTaskUseCase)
    {
        return $getTaskUseCase->execute($taskId);
    }

    protected function buildForm(TaskModel $model): FormInterface
    {
        return $this->createForm(TaskType::class, $model);
    }
}
