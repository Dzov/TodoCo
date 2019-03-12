<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Exception\User\UserNotFoundException;
use App\Form\User\UserType;
use App\Model\User\UserModel;
use App\UseCase\User\EditUser;
use App\UseCase\User\GetUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class EditUserController extends AbstractController
{
    /**
     * @Route("/users/{userId}/edit", name="edit_user", requirements={"userId"="^\d{1,10}$"})
     */
    public function edit(int $userId, Request $request, GetUser $getUser, EditUser $editUser)
    {
        try {
            $user = $getUser->execute($userId);

            $form = $this->buildForm($this->buildModel($user));

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $editUser->execute($form->getData());

                $this->addFlash('success', "L'utilisateur a bien été modifié");

                return $this->redirectToRoute('list_users');
            }
        } catch (UserNotFoundException $e) {
            throw $this->createNotFoundException();
        }

        return $this->render('user/edit.html.twig', ['form' => $form->createView(), 'user' => $user]);
    }

    private function buildModel(User $user)
    {
        $model = new UserModel();
        $model->setEmail($user->getEmail());
        $model->setId($user->getId());
        $model->setPassword($user->getPassword());
        $model->setUsername($user->getUsername());

        return $model;
    }

    protected function buildForm(UserModel $model): FormInterface
    {
        $form = $this->createForm(UserType::class, $model);

        return $form;
    }
}
