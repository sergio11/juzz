<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use juzz\UsuariosBundle\Entity\Usuarios AS UsuarioEntity;
use juzz\UsuariosBundle\Form\UsuarioRegistroType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

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

    public function profileAction(Request $request)
    {
      return $this->render('juzzUsuariosBundle:Usuarios:profile.html.twig');
    }

    //Muestra el formulario de Login.
    public function loginAction(Request $request)
    {
          $sesion = $request->getSession();

          $defaultData = array('message' => 'Type your message here');
          $form = $this->createFormBuilder($defaultData)
          ->add('email', 'email',array(
              'constraints' => array(
                new NotBlank(),
                new Length(array('min' => 3)),
              )
          ))
          ->add('password', 'password')
          ->add('send', 'submit')
          ->getForm();

          $form->handleRequest($request);

          if ($form->isValid()) {
              // data es un array con claves 'name', 'email', y 'message'
              $data = $form->getData();
          }

          $error = $request->attributes->get(
              SecurityContext::AUTHENTICATION_ERROR,
              $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
          );

          return $this->render('juzzUsuariosBundle:Usuarios:login.html.twig', array(
              'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
              'error'         => $error,
              'form' => $form
          ));

    }

    /**
 * Muestra el formulario para que se registren los nuevos usuarios. Además
 * se encarga de procesar la información y de guardar la información en la base de datos
 */
 public function registroAction(Request $request){

  $em = $this->getDoctrine()->getManager();
  $user = new UsuarioEntity();

  $form = $this->createForm(new UsuarioRegistroType(), $user);
  $form->handleRequest($request);

  if ($form->isValid()) {
    //Necesitamos saber el algoritmo de codificación utilizado en la contraseña.
    //Para poderlo aplicar a nuestros usuarios.
    $encoder = $this->get('security.encoder_factory')->getEncoder($user);
    $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
    $user->setPassword($password);
    $user->setIngreso(new \DateTime());
    // Guardar el nuevo usuario en la base de datos
    $em->persist($user);
    $em->flush();

    // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
    $this->get('ras_flash_alert.alert_reporter')->addSuccess('¡Enhorabuena! Te has registrado correctamente en Juzz');

    // Loguear al usuario automáticamente
    $token = new UsernamePasswordToken($user, null, 'juzz', $user->getRoles());
    $this->container->get('security.context')->setToken($token);

    return $this->redirect($this->generateUrl('perfil'));
  }

  return $this->render('juzzUsuariosBundle:Usuarios:registro.html.twig', array(
    'form' => $form->createView()
  ));
  }
}
