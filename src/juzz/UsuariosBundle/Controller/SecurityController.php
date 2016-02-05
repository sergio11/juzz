<?php
namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
	//Muestra el formulario de Login.
    public function loginAction(Request $request)
    {	

      $sesion = $request->getSession();
      $error = $request->attributes->get(
        SecurityContext::AUTHENTICATION_ERROR,
        $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
      );
    	$requestStack = $this->get('request_stack')->getParentRequest();
    	//Comprobamos si es una sub request.
      if ($requestStack) {
      	//Obtenemos contenido del formulario.
      	$body = $this->renderView('juzzUsuariosBundle:Accounts:security/form_login.html.twig');
      	//Obtenemos Contenido del Footer.
      	$footer = $this->renderView('juzzUsuariosBundle:Accounts:registration/registerNotice.html.twig');
      	$response =  $this->render('::components/modal.html.twig', array(
      		'identifier' => 'login',
      		'title' => 'login.modal.header.title',
      		'body' => $body,
      		'footer' => $footer
      	));

      }else{
      	$response = $this->render('juzzUsuariosBundle:Accounts:security/login.html.twig',array(
        	'last_email' => $sesion->get(SecurityContext::LAST_USERNAME),
        	'error' => $error)
        );
      }

      return $response;
     
    }

}