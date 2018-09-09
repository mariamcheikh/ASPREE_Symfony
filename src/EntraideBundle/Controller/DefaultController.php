<?php

namespace EntraideBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EntraideBundle:Default:index.html.twig');
    }
}
