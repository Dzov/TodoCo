<?php

namespace AppBundle\Controller\Task;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class ListTasksController extends Controller
{
    public function listAction()
    {
        return $this->render(
            'task/list.html.twig',
            ['tasks' => $this->getDoctrine()->getRepository('AppBundle:Task')->findAll()]
        );
    }
}
