<?php

namespace juzz\FilesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('juzzFilesBundle:Default:index.html.twig', array('name' => $name));
    }
}
