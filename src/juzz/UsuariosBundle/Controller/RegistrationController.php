<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use juzz\UsuariosBundle\Entity\Usuarios AS UsuarioEntity;
use juzz\FilesBundle\Entity\Imagenes AS ImagenEntity;
use juzz\UsuariosBundle\Entity\Paises AS CountryEntity;
use juzz\UsuariosBundle\Form\UsuarioRegistroType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;



class RegistrationController extends Controller{

	// Muestra el formulario para que se registren los nuevos usuarios.
  public function registroAction(Request $request){

    $em = $this->getDoctrine()->getManager();

    $user = new UsuarioEntity();
    $avatar = new ImagenEntity();
    $user->setAvatar($avatar);

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
    
      //Persistimos el avatar.
      $em->persist($avatar);
      //Necesitamos saber el algoritmo de codificación utilizado en la contraseña.
      //Para poderlo aplicar a nuestros usuarios.
      $encoder = $this->get('security.encoder_factory')->getEncoder($user);
      $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
      $user->setPassword($password);
      $user->setIngreso(new \DateTime());
      $user->setActivo(2);
      $user->setProfileBg($avatar);
      //Establecemos politica de comentarios por defecto.
      $policy = $em->getRepository('juzzUsuariosBundle:PoliticaComentarios')->find(1);
      $user->setPoliticaComentarios($policy);
      // Guardar el nuevo usuario en la base de datos
      $em->persist($user);
      $em->flush();

      // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
      $this->get('ras_flash_alert.alert_reporter')->addSuccess('¡Enhorabuena! Te has registrado correctamente en Juzz, consulta tu correo para obtener más información');
      // Loguear al usuario automáticamente
      $token = new UsernamePasswordToken($user, $user->getPassword(), 'frontend', $user->getRoles());
      $this->container->get('security.context')->setToken($token);
      //Redirigimos a su página de perfil.
      return $this->redirect($this->generateUrl('perfil',array('user' => $user->getNick() )));
    }

    return $this->render('juzzUsuariosBundle:Accounts:register.html.twig',array(
        'form' =>  $form->createView(),
        'tab' => 'register'
    ));
  }
}