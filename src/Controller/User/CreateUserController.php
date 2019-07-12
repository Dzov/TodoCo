<?php

namespace App\Controller\User;

use App\Exception\User\EmailAlreadyExistsException;
use App\Form\User\UserType;
use App\Model\User\UserModel;
use App\UseCase\User\CreateUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CreateUserController extends AbstractController
{
    /**
     * @Route("/admin/users/create", name="create_user")
     */
    public function create(Request $request, CreateUser $createUserUseCase)
    {
        try {
            $user = new UserModel();
            $form = $this->createForm(
                UserType::class,
                $user,
                ['required' => true, 'validation_groups' => UserType::ADMIN_VALIDATION_GROUP]
            );

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $createUserUseCase->execute($form->getData());

                $this->addFlash('success', "L'utilisateur a bien été ajouté.");

                return $this->redirectToRoute('list_users');
            }
        } catch (EmailAlreadyExistsException $eaee) {
            $form['email']->addError(new FormError('Cet email est déjà utilisé'));
        }

        return $this->render('user/create.html.twig', ['form' => $form->createView()]);
    }
}
