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
     * @Route("/tasks/{filter}", name="list_tasks",  requirements={"filter": "in-progress|completed|starred"})
     */
    public function list(GetTasks $getTasksUseCase, string $filter = null)
    {
        $tasks = $getTasksUseCase->execute($filter ? [$filter] : []);

        return $this->render('task/list.html.twig', ['tasks' => $tasks, 'filter' => $filter]);
    }
}
