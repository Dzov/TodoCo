<?php

namespace App\Controller\User;

use App\Exception\User\EmailAlreadyExistsException;
use App\Form\User\UserType;
use App\Model\User\UserModel;
use App\UseCase\User\CreateUser;
use App\UseCase\User\GetUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class CreateUserController extends AbstractController
{
    /**
     * @Route("/users/create", name="create_user")
     */
    public function create(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        CreateUser $createUserUseCase,
        GetUser $getUserUseCase
    ) {
        try {
            $user = new UserModel();
            $form = $this->createForm(UserType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $createUserUseCase->execute($form->getData());

                $this->addFlash('success', "L'utilisateur a bien été ajouté.");

                return $this->redirectToRoute('list_users');
            }
        } catch (EmailAlreadyExistsException $eaee) {
            $this->addFlash('danger', 'Cet email est déjà utilisé');
        }

        return $this->render('user/create.html.twig', ['form' => $form->createView()]);
    }
}
