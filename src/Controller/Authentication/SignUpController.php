<?php

namespace App\Controller\Authentication;

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
class SignUpController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, CreateUser $createUser)
    {
        try {
            $userModel = new UserModel();
            $form = $this->createForm(
                UserType::class,
                $userModel,
                ['required' => true,]
            );

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $createUser->execute($form->getData());

                $this->addFlash('success', "Votre compte a bien été créé.");

                return $this->redirectToRoute('login');
            }
        } catch (EmailAlreadyExistsException $eaee) {
            $form['email']->addError(new FormError('Cet email existe déjà'));
        }

        return $this->render('security/register.html.twig', ['form' => $form->createView()]);
    }
}
