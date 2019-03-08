<?php

namespace AppBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ListUsersController extends Controller
{
    public function listAction()
    {
        return $this->render(
            'user/list.html.twig',
            ['users' => $this->getDoctrine()->getRepository('AppBundle:User')->findAll()]
        );
    }
}
