<?php

namespace App\Controller\Task;

use App\Form\Task\Model\TaskModel;
use App\UseCase\Task\CreateTask;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CreateTaskController extends AbstractTaskController
{
    /**
     * @Route("/tasks/create", name="create_task")
     */
    public function create(Request $request, CreateTask $createTask)
    {
        $form = $this->buildForm(new TaskModel());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $createTask->execute($form->getData());

            $this->addFlash('success', 'La tâche a été bien été ajoutée.');

            return $this->redirectToRoute('list_tasks');
        }

        return $this->render('task/create.html.twig', ['form' => $form->createView()]);
    }
}
