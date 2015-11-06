<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UsuariosController extends Controller
{
    public function indexAction(Request $request)
    {
    	$repository = $this->getDoctrine()->getRepository('juzzEpisodiosBundle:Categorias');
    	$categories = $repository->findBy(
		    array('parent'  => null)
		);
        $response =  $this->render(':default:index.html.twig',array('categories' => $categories));
        return $response;

    }

    //Muestra el formulario de Login.
    public function loginAction(Request $request)
    {
        $sesion = $request->getSession();

        $error = $request->attributes->get(
            SecurityContext::AUTHENTICATION_ERROR,
            $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );

        return $this->render('UsuarioBundle:Default:login.html.twig', array(
            'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
            'error'         => $error
        ));
    }
}
