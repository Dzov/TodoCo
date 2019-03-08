<?php

namespace App\Controller\Home;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @author Amélie Haladjian <amelie.haladjian@gmail.com>
 */
class HomeController extends AbstractController
{
    public function index()
    {
        return $this->render('default/index.html.twig');
    }
}
