<?php

namespace App\Controller\User;

use App\UseCase\User\GetUsers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ListUsersController extends AbstractController
{
    /**
     * @Route("/admin/users", name="list_users")
     */
    public function listAction(GetUsers $getUsersUseCase)
    {
        return $this->render(
            'user/list.html.twig',
            ['users' => $getUsersUseCase->execute()]
        );
    }
}
