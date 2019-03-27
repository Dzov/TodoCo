<?php

namespace App\Controller\Task;

use App\Exception\User\UserNotFoundException;
use App\Model\Task\TaskModel;
use App\UseCase\Task\CreateTask;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CreateTaskController extends AbstractTaskController
{
    /**
     * @Route("/tasks/create", name="create_task")
     */
    public function create(Request $request, CreateTask $createTaskUseCase, UserInterface $user)
    {
        try {
            $form = $this->buildForm(new TaskModel($user->getId()));

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $createTaskUseCase->execute($form->getData());

                $this->addFlash('success', 'La tâche a bien été ajoutée.');

                return $this->redirectToRoute('list_tasks');
            }
        } catch (UserNotFoundException $e) {
            $this->addFlash('danger', 'Une erreur est survenue, essayer de vous reconnecter');
        }

        return $this->render('task/create.html.twig', ['form' => $form->createView()]);
    }
}
