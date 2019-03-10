<?php

namespace App\Controller\Task;

use App\Exception\Task\TaskNotFoundException;
use App\UseCase\Task\DeleteTask;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class DeleteTaskController extends AbstractController
{
    /**
     * @Route("/tasks/{taskId}/delete", name="delete_task", requirements={"taskId"="^\d{1,10}$"})
     */
    public function delete(int $taskId, DeleteTask $deleteTask)
    {
        try {
            $deleteTask->execute($taskId);
            $this->addFlash('success', 'La tâche a bien été supprimée.');

            return $this->redirectToRoute('list_tasks');
        } catch (TaskNotFoundException $e) {
            throw $this->createNotFoundException();
        }
    }
}
