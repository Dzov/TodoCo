<?php

namespace App\Controller\Task;

use App\UseCase\Task\GetTasks;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ListTasksController extends AbstractTaskController
{
    /**
     * @Route("/tasks", name="list_tasks")
     */
    public function list(GetTasks $getTasksUseCase)
    {
        return $this->render(
            'task/list.html.twig',
            ['tasks' => $getTasksUseCase->execute()]
        );
    }
}
