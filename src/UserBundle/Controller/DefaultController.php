<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
    public function adminAction()
    {
        return $this->render('UserBundle:Default:admin.html.twig');
    }


    public function getParent() 
    {
        return 'FOSUserBundle';
    }
}
