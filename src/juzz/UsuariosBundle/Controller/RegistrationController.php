<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use juzz\UsuariosBundle\Entity\Usuarios AS UsuarioEntity;
use juzz\FilesBundle\Entity\Imagenes AS ImagenEntity;
use juzz\FilesBundle\Entity\ProfileBackground;
use juzz\UsuariosBundle\Entity\Paises AS CountryEntity;
use juzz\UsuariosBundle\Form\UsuarioRegistroType;
use juzz\UsuariosBundle\UsuariosBundleEvents;
use juzz\UsuariosBundle\Event\FormEvent;



class RegistrationController extends Controller{

	// Muestra el formulario para que se registren los nuevos usuarios.
  public function registroAction(Request $request){

    $em = $this->getDoctrine()->getManager();
    /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
   $dispatcher = $this->get('event_dispatcher');

    $user = new UsuarioEntity();

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
        
        $event = new FormEvent($form, $request);
        $dispatcher->dispatch(UsuariosBundleEvents::REGISTRATION_SUCCESS, $event);
        
        //Necesitamos saber el algoritmo de codificación utilizado en la contraseña.
        //Para poderlo aplicar a nuestros usuarios.
        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
        $user->setPassword($password);
        $user->setIngreso(new \DateTime());
        $user->setActivo(1);
        //Establecemos politica de comentarios por defecto.
        $policy = $em->getRepository('juzzCommentsBundle:PoliticaComentarios')->find(1);
        $user->setPoliticaComentarios($policy);
        // Guardar el nuevo usuario en la base de datos
        $em->persist($user);
        $em->flush();

        if (null === $response = $event->getResponse()) {
            // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
            $this->get('ras_flash_alert.alert_reporter')->addSuccess('¡Enhorabuena! Te has registrado correctamente en Juzz, consulta tu correo para obtener más información');
            // Loguear al usuario automáticamente
            $token = new UsernamePasswordToken($user, $user->getPassword(), 'frontend', $user->getRoles());
            $this->container->get('security.context')->setToken($token);
            //Redirigimos a su página de perfil.
            $response =  $this->redirect($this->generateUrl('perfil',array('user' => $user->getNick() )));
        }
        
        return $response;

    }

    return $this->render('juzzUsuariosBundle:Accounts:register.html.twig',array(
        'form' =>  $form->createView(),
        'tab' => 'register'
    ));
  }
  
   /**
     * Tell the user to check his email provider
     */
    public function checkEmailAction()
    {
        $email = $this->get('session')->get('fos_user_send_confirmation_email/email');
        $this->get('session')->remove('fos_user_send_confirmation_email/email');
        $user = $this->get('fos_user.user_manager')->findUserByEmail($email);
        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with email "%s" does not exist', $email));
        }
        return $this->render('FOSUserBundle:Registration:checkEmail.html.twig', array(
            'user' => $user,
        ));
    }
  
  /**
     * Receive the confirmation token from user email provider, login the user
     */
    public function confirmAction(Request $request, $token)
    {
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByConfirmationToken($token);
        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with confirmation token "%s" does not exist', $token));
        }
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');
        $user->setConfirmationToken(null);
        $user->setEnabled(true);
        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_CONFIRM, $event);
        $userManager->updateUser($user);
        if (null === $response = $event->getResponse()) {
            $url = $this->generateUrl('fos_user_registration_confirmed');
            $response = new RedirectResponse($url);
        }
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_CONFIRMED, new FilterUserResponseEvent($user, $request, $response));
        return $response;
    }
    /**
     * Tell the user his account is now confirmed
     */
    public function confirmedAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        return $this->render('FOSUserBundle:Registration:confirmed.html.twig', array(
            'user' => $user,
            'targetUrl' => $this->getTargetUrlFromSession(),
        ));
    }
    
}