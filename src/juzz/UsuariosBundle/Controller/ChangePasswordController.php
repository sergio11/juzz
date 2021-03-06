<?php
namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use juzz\UsuariosBundle\Form\UserChangePasswordType;

/**
 * Este controlador gestiona el cambio de contraseñas
 */
class ChangePasswordController extends Controller
{
	/**
	*	Formulario de cambio de contraseña.
	*/
	public function showAction(){
		
		$form = $this->createForm(new UserChangePasswordType(), $this->getUser());
		$requestStack = $this->get('request_stack')->getParentRequest();
    	//Comprobamos si es una sub request.
      	if ($requestStack) {
      		//Obtenemos cuerpo de la modal.
	      	$body = $this->renderView('juzzUsuariosBundle:Accounts:changePassword/change_form.html.twig',array(
	      		'form' => $form->createView()
	      	));
	      	$response =  $this->render('::components/modal.html.twig', array(
	      		'identifier' => 'changePassword',
	      		'title' => 'change_password.modal.title',
	      		'body' => $body
	      	));

      	}else{
	      	$response = $this->render('juzzUsuariosBundle:Accounts:changePassword/change.html.twig',array(
	      		'form' => $form->createView()
	      	));
      	}

      	return $response;

	}

	/**
    * Cambia la password del usuario.
    */
    public function changeAction(Request $request)
    {	
    	$user = $this->getUser();
    	$form = $this->createForm(new UserChangePasswordType(),$user );
       	$form->handleRequest($request);
       	if ($form->isValid()) {
       		$em = $this->getDoctrine()->getManager();
       		$encoder = $this->get('security.encoder_factory')->getEncoder($user);
	        $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
	        $user->setPassword($password);
	        $em->flush();
       		$translated = $this->get('translator')->trans('change_password.flash.success',array(),'juzzUsuariosBundle');
            // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
            $this->get('ras_flash_alert.alert_reporter')->addSuccess($translated);
        	//Redirigimos a editar perfil.
        	$response =  $this->redirect($this->generateUrl('editar_perfil',array('user' => $user->getNick())));
        }else{
        	$response = $this->render('juzzUsuariosBundle:Accounts:changePassword/change.html.twig',array(
	      		'form' => $form->createView()
	      	));
        }

        return $response;

    }
}