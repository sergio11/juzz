<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use juzz\UsuariosBundle\Entity\Usuarios AS UsuarioEntity;
use juzz\UsuariosBundle\Entity\Paises AS CountryEntity;
use juzz\UsuariosBundle\Form\UsuarioRegistroType;
use juzz\UsuariosBundle\UsuariosBundleEvents;
use juzz\UsuariosBundle\Event\RegistrationEvent;
use juzz\UsuariosBundle\Event\RegistrationConfirmedEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



class RegistrationController extends Controller{

	// Muestra el formulario para que se registren los nuevos usuarios.
  public function registerAction(Request $request){

    $em = $this->getDoctrine()->getManager();
    /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
    $dispatcher = $this->get('event_dispatcher');

    $user = new UsuarioEntity();
    $user->setLastModified(new \DateTime());
    
    if ($request->getMethod() == 'GET') {
      //Usar getClientIp.
      $content = @file_get_contents('http://www.geoplugin.net/php.gp?ip=212.128.152.1');
      if (isset($http_response_header) && strpos($http_response_header[0],'200')){
        $meta = unserialize($content);
        //Obtenemos el pais.
        $defaultCountry = $em->getRepository('juzzUsuariosBundle:Paises')->findOneBy(array('iso' => $meta['geoplugin_countryCode']));
        //Establecemos origen por defecto.
        $user->setOrigen($defaultCountry);
      }
    }
  
    $form = $this->createForm(new UsuarioRegistroType(), $user);
    $form->handleRequest($request);

    if ($form->isValid()) {
        
        $event = new RegistrationEvent($form, $user);
        $dispatcher->dispatch(UsuariosBundleEvents::REGISTRATION_SUCCESS, $event);

        //Necesitamos saber el algoritmo de codificación utilizado en la contraseña.
        //Para poderlo aplicar a nuestros usuarios.
        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
        $user->setPassword($password);
        $user->setIngreso(new \DateTime());

        //Establecemos politica de comentarios por defecto.
        $policy = $em->getRepository('juzzCommentsBundle:PoliticaComentarios')->find(1);
        $user->setPoliticaComentarios($policy);

        if (null === $response = $event->getResponse()) {
            $user->setActivo(1);
            
            $translated = $this->get('translator')->trans('registration.flash.user_created',array(
                '%username%' => $user->getFullName()
            ),'juzzUsuariosBundle');
            // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
            $this->get('ras_flash_alert.alert_reporter')->addSuccess($translated);
            //Notificamos que la cuenta ha sido activada.
            $event = new RegistrationConfirmedEvent($user);
            $dispatcher->dispatch(UsuariosBundleEvents::REGISTRATION_CONFIRM, $event);
            if (null === $response = $event->getResponse()) {
                $response = $this->redirect($this->generateUrl('confirmed'));
            }
        }
            
        // Guardar el nuevo usuario en la base de datos
        $em->persist($user);
        $em->flush();
        
        return $response;

    }

    return $this->render('juzzUsuariosBundle:Accounts:registration/register.html.twig',array(
        'form' =>  $form->createView(),
        'tab' => 'register'
    ));
  }
  
   /**
    * Le indica al usuario que revise su correo para activar su cuenta.
    */
    public function checkEmailAction()
    {
        $email = $this->get('session')->get('juzz_user_send_confirmation_email/email');
        $this->get('session')->remove('juzz_user_send_confirmation_email/email');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('juzzUsuariosBundle:Usuarios')->findOneBy(array(
            'email' => $email
        ));
        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with email "%s" does not exist', $email));
        }
        return $this->render('juzzUsuariosBundle:Accounts:registration/checkEmail.html.twig', array(
            'user' => $user,
        ));
    }
  
    /**
    * Recibe el token de confirmación y procede a activarlo.
    */
    public function confirmAction(Request $request, $token)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('juzzUsuariosBundle:Usuarios')->findOneBy(array(
            'confirmationToken' => $token
        ));
        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with confirmation token "%s" does not exist', $token));
        }
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');
        $user->setConfirmationToken(null);
        $user->setActivo(1);
        $em->flush();
        
        //Notificamos que la cuenta ha sido activada.
        $event = new RegistrationConfirmedEvent($user);
        $dispatcher->dispatch(UsuariosBundleEvents::REGISTRATION_CONFIRM, $event);
        
        if (null === $response = $event->getResponse()) {
            $response = $this->redirect($this->generateUrl('confirmed',array('user' => $user->getNick())));
        }
        
        return $response;
    }
    /**
     * Tell the user his account is now confirmed
     * @ParamConverter("user", options={"mapping": {"user" = "nick"}})
     */
    public function confirmedAction(UsuarioEntity $user)
    {
        return $this->render('juzzUsuariosBundle:Accounts:registration/confirmed.html.twig',array(
            'user' => $user
        ));
    }
    
}