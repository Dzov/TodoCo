<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ListUsersController extends AbstractController
{
    public function listAction()
    {
        return $this->render(
            'user/list.html.twig',
            ['users' => $this->getDoctrine()->getRepository('AppBundle:User')->findAll()]
        );
    }
}
