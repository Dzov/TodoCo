<?php

namespace App\Controller\Task;

use App\Exception\Task\TaskNotFoundException;
use App\UseCase\Task\ToggleTask;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ToggleTaskStatusController extends AbstractController
{
    /**
     * @Route("/tasks/{taskId}/toggle", name="toggle_task", requirements={"taskId"="^\d{1,10}$"})
     */
    public function toggle(int $taskId, ToggleTask $useCase)
    {
        try {
            $task = $useCase->toggleStatus($taskId);

            $task->getIsDone()
                ? $this->addFlash('success', sprintf('Tâche %s est terminée !', $task->getTitle()))
                : $this->addFlash('success', sprintf('La tâche %s a bien été marquée non terminée.', $task->getTitle()));

            return $this->redirectToRoute('list_tasks');
        } catch (TaskNotFoundException $e) {
            throw $this->createNotFoundException();
        }
    }
}
