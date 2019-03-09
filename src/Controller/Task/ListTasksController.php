<?php

namespace App\Controller\Task;

use App\UseCase\Task\Admin\GetTasks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ListTasksController extends AbstractController
{
    /**
     * @Route("/tasks", name="list_tasks")
     */
    public function list(GetTasks $useCase)
    {
        return $this->render(
            'task/list.html.twig',
            ['tasks' => $useCase->execute()]
        );
    }
}
