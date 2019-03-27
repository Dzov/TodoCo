<?php

namespace App\Controller\Task;

use App\Exception\Task\InvalidTaskFilterException;
use App\UseCase\Task\GetTasks;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ListTasksController extends AbstractTaskController
{
    /**
     * @Route("/tasks", name="list_tasks")
     */
    public function list(Request $request, GetTasks $getTasksUseCase)
    {
        try {
            $tasks = $getTasksUseCase->execute($request->get('filters') ?? []);

            return $this->render('task/list.html.twig', ['tasks' => $tasks]);
        } catch (InvalidTaskFilterException $e) {
            throw $this->createAccessDeniedException();
        }
    }
}
