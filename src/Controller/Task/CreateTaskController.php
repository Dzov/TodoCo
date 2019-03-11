<?php

namespace App\Controller\Task;

use App\Entity\Task;
use App\Form\Task\TaskType;
use App\UseCase\Task\CreateTask;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CreateTaskController extends AbstractController
{
    /**
     * @Route("/tasks/create", name="create_task")
     */
    public function create(Request $request, CreateTask $createTask)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $createTask->execute($task);

            $this->addFlash('success', 'La tâche a été bien été ajoutée.');

            return $this->redirectToRoute('list_tasks');
        }

        return $this->render('task/create.html.twig', ['form' => $form->createView()]);
    }
}
