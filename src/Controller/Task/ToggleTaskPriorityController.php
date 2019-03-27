<?php

namespace App\Controller\Task;

use App\Exception\Task\TaskNotFoundException;
use App\UseCase\Task\ToggleTaskPriority;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ToggleTaskPriorityController extends AbstractController
{
    /**
     * @Route("/tasks/{taskId}/prioritize", name="prioritize_task", requirements={"taskId"="^\d{1,10}$"})
     */
    public function togglePriority(int $taskId, ToggleTaskPriority $togglePriorityUseCase)
    {
        try {
            $togglePriorityUseCase->execute($taskId);

            $this->addFlash('success', 'La tâche a bien été mise à jour');

            return $this->redirectToRoute('list_tasks');
        } catch (TaskNotFoundException $e) {
            throw $this->createNotFoundException();
        }
    }
}
