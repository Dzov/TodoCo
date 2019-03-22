<?php

namespace App\Controller\Task;

use App\UseCase\Task\GetTasks;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ListTasksController extends AbstractTaskController
{
    /**
     * @Route("/tasks", name="list_tasks")
     */
    public function list(GetTasks $getTasksUseCase, UserInterface $user)
    {
        dump($user->getRoles());
        die;
        return $this->render(
            'task/list.html.twig',
            ['tasks' => $getTasksUseCase->execute()]
        );
    }
}
