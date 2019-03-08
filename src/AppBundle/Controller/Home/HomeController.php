<?php

namespace AppBundle\Controller\Home;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
}
