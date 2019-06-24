<?php

namespace App\Controller\User;

use App\Exception\User\EmailAlreadyExistsException;
use App\Exception\User\UserNotFoundException;
use App\Form\User\UserType;
use App\Model\User\UserModel;
use App\Model\User\UserModelAssembler;
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
     * @Route("/admin/users/{userId}/edit", name="edit_user", requirements={"userId"="^\d{1,10}$"})
     */
    public function edit(
        int $userId,
        Request $request,
        GetUser $getUserUseCase,
        EditUser $editUserUseCase,
        UserModelAssembler $modelAssembler
    ) {
        try {
            $user = $getUserUseCase->execute($userId);

            $form = $this->buildForm($modelAssembler->createFromEntity($user));

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $editUserUseCase->execute($form->getData());

                $this->addFlash('success', "L'utilisateur a bien été modifié");

                return $this->redirectToRoute('list_users');
            }
        } catch (UserNotFoundException $e) {
            throw $this->createNotFoundException();
        } catch (EmailAlreadyExistsException $eaee) {
            $this->addFlash('danger', 'Cet email est déjà utilisé');
        }

        return $this->render('user/edit.html.twig', ['form' => $form->createView(), 'user' => $user]);
    }

    protected function buildForm(UserModel $model): FormInterface
    {
        return $this->createForm(UserType::class, $model, ['edit' => true]);
    }
}
