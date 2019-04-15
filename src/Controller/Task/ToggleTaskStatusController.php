<?php

namespace App\Controller\Task;

use App\Exception\Task\TaskNotFoundException;
use App\UseCase\Task\ToggleTaskStatus;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ToggleTaskStatusController extends AbstractTaskController
{
    /**
     * @Route("/tasks/{taskId}/toggle", name="toggle_task", requirements={"taskId"="^\d{1,10}$"})
     */
    public function toggleStatus(int $taskId, ToggleTaskStatus $toggleTaskUseCase)
    {
        try {
            $task = $toggleTaskUseCase->execute($taskId);

            $task->isDone()
                ? $this->addFlash('success', sprintf('La tâche %s est terminée !', $task->getTitle()))
                : $this->addFlash('success', sprintf('La tâche %s a bien été marquée non terminée.', $task->getTitle())
            );

            return $this->redirectToRoute('list_tasks');
        } catch (TaskNotFoundException $e) {
            throw $this->createNotFoundException();
        }
    }
}
