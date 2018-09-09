<?php

namespace GPublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('GPublicationBundle:Default:index.html.twig');
    }
}
