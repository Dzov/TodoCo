<?php

namespace App\Controller\Task;

use App\Exception\Task\TaskNotFoundException;
use App\Model\Task\TaskModelAssembler;
use App\UseCase\Task\EditTask;
use App\UseCase\Task\GetTask;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class EditTaskController extends AbstractTaskController
{
    /**
     * @Route("/tasks/{taskId}/edit", name="edit_task", requirements={"taskId"="^\d{1,10}$"})
     */
    public function edit(
        int $taskId,
        Request $request,
        GetTask $getTaskUseCase,
        EditTask $editTaskUseCase,
        TaskModelAssembler $modelAssembler
    ) {
        try {
            $task = $this->getTask($taskId, $getTaskUseCase);
            $form = $this->buildForm($modelAssembler->createFromEntity($task));

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $editTaskUseCase->execute($form->getData());
                $this->addFlash('success', 'La tâche a bien été modifiée.');

                return $this->redirectToRoute('list_tasks');
            }

            return $this->render(
                'task/edit.html.twig',
                [
                    'form' => $form->createView(),
                    'task' => $task,
                ]
            );
        } catch (TaskNotFoundException $e) {
            throw $this->createNotFoundException();
        }
    }
}
