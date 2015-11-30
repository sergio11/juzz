<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use juzz\UsuariosBundle\Entity\Usuarios AS UsuarioEntity;
use juzz\FilesBundle\Entity\Imagenes AS ImagenEntity;
use juzz\UsuariosBundle\Form\UsuarioRegistroType;


class RegistrationController extends Controller{

	// Muestra el formulario para que se registren los nuevos usuarios.
  public function registroAction(Request $request){

    $user = new UsuarioEntity();
    $avatar = new ImagenEntity();
    $user->setAvatar($avatar);

    $form = $this->createForm(new UsuarioRegistroType(), $user);
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();

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
      // Guardar el nuevo usuario en la base de datos
      $em->persist($user);
      $em->flush();

      // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
      $this->get('ras_flash_alert.alert_reporter')->addSuccess('¡Enhorabuena! Te has registrado correctamente en Juzz');
      $this->get('ras_flash_alert.alert_reporter')->addSuccess("Tu contraseña es " .$password . " y tiene ");
      // Loguear al usuario automáticamente
      $token = new UsernamePasswordToken($user, $user->getPassword(), 'frontend', $user->getRoles());
      $this->container->get('security.context')->setToken($token);

      return $this->redirect($this->generateUrl('perfil',array('user' => $user->getNick() )));
    }

    return $this->render('juzzUsuariosBundle:Accounts:register.html.twig',array(
        'form' =>  $form->createView(),
        'tab' => 'register'
    ));
  }
}