<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UsersController extends Controller
{
    public function indexAction()
    {
        return $this->render('juzzUsuariosBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function loginAction()
    {
       
    }
}
