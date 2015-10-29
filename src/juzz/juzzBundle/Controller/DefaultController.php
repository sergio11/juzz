<?php

namespace juzz\juzzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('juzzjuzzBundle:Default:index.html.twig', array('name' => $name));
    }
}
