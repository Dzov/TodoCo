<?php

namespace App\Controller\Task;

use App\Entity\Task\TaskAction;
use App\Exception\Task\TaskNotFoundException;
use App\UseCase\Task\DeleteTask;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class DeleteTaskController extends AbstractTaskController
{
    /**
     * @Route("/tasks/{taskId}/delete", name="delete_task", requirements={"taskId"="^\d{1,10}$"})
     */
    public function delete(int $taskId, DeleteTask $deleteTaskUseCase)
    {
        $this->denyAccessUnlessGranted(TaskAction::CAN_USER_DELETE_TASK, $taskId);

        try {
            $deleteTaskUseCase->execute($taskId);
            $this->addFlash('success', 'La tâche a bien été supprimée.');

            return $this->redirectToRoute('list_tasks');
        } catch (TaskNotFoundException $e) {
            throw $this->createNotFoundException();
        }
    }
}
