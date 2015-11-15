<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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

          return $this->render('UsuarioBundle:Default:login.html.twig', array(
              'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
              'error'         => $error,
              'form' => $form
          ));

    }

    /**
 * Muestra el formulario para que se registren los nuevos usuarios. Además
 * se encarga de procesar la información y de guardar la información en la base de datos
 */
 public function singUpAction(Request $peticion)
 {
    $em = $this->getDoctrine()->getManager();
    $usuario = new Usuario();
    $usuario->setPermiteEmail(true);
    $formulario = $this->createForm(new UsuarioRegistroType(), $usuario);
    $formulario->handleRequest($peticion);
    if ($formulario->isValid()) {
        // Completar las propiedades que el usuario no rellena en el formulario
        $usuario->setSalt(md5(time()));
        $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
        $passwordCodificado = $encoder->encodePassword(
            $usuario->getPassword(),
            $usuario->getSalt()
        );
        $usuario->setPassword($passwordCodificado);
        // Guardar el nuevo usuario en la base de datos
        $em->persist($usuario);
        $em->flush();
        // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
        $this->get('session')->getFlashBag()->add('info',
            '¡Enhorabuena! Te has registrado correctamente en Cupon'
        );
        // Loguear al usuario automáticamente
        $token = new UsernamePasswordToken($usuario, null, 'frontend', $usuario->getRoles());
        $this->container->get('security.context')->setToken($token);
        return $this->redirect($this->generateUrl('portada', array(
            'ciudad' => $usuario->getCiudad()->getSlug()
        )));
    }
    return $this->render('UsuarioBundle:Default:registro.html.twig', array(
        'formulario' => $formulario->createView()
    ));
  }
}
