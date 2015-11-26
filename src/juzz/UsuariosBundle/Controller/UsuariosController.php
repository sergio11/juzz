<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use juzz\UsuariosBundle\Entity\Usuarios AS UsuarioEntity;
use juzz\FilesBundle\Entity\Imagenes AS ImagenEntity;
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
      $login_data = $this->loginAction($request);
      $response =  $this->render(':default:index.html.twig',array(
        'categories' => $categories,
        'login_data' => $login_data
      ));
      return $response;

    }

    public function accountsAction(Request $request)
    {

      $login_data = $this->loginAction($request);
      $register_data = $this->registroAction($request);
      //Comprobamos si se ha registrado
      if(isset($register_data['registered'])){
        //la respuesta será una redirección al perfil del usuario.
        $response = $register_data['redirect'];
      }else{
        $response = $this->render('juzzUsuariosBundle:Usuarios:accounts.html.twig',array(
          'tab' => $request->query->get('tab'),
          'login_data' => $login_data,
          'register_data' => $register_data
        ));
      }
      return $response;
    }

    public function profileAction(Request $request,$user)
    {
      if ($user == 'default') {
        $user = $this->getUser();
      }else{
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('juzzUsuariosBundle:Usuarios')->findOneBy(array('nick' => $user));
      }

      return $this->render('juzzUsuariosBundle:Usuarios:profile.html.twig',array(
        'name' => $user->getNombre(),
        'apellidos' => $user->getApellidos(),
        'avatar' => $user->getAvatar()->getWebPath()

      ));
    }

    //Muestra el formulario de Login.
    public function loginAction(Request $request)
    {
      
      $sesion = $request->getSession();
      $error = $request->attributes->get(
        SecurityContext::AUTHENTICATION_ERROR,
        $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
      );

      return array(
        'last_email' => $sesion->get(SecurityContext::LAST_USERNAME),
        'error' => $error
      );

    }

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

      return array(
        'registered' => true,
        'redirect' => $this->redirect($this->generateUrl('perfil',array('user' => $user->getNick() )))
      );
    }

    return array(
      'form' => $form->createView()
    );
  }


  public function followersAction(Request $request){

    $dummyPhoto = $this->getUser()->getAvatar()->getWebPath();
    $followers = array(
      array(
        'photo' => $dummyPhoto,
        'name' => 'Jose David Quirós',
        'followers' => 0
      ),
      array(
        'photo' => $dummyPhoto,
        'name' => 'David Martín Sánchez',
        'followers' => 0
      ),
      array(
        'photo' => $dummyPhoto,
        'name' => 'Jose David Quirós',
        'followers' => 0
      )
    );

    return $this->render('juzzUsuariosBundle:Usuarios:last_followers.html.twig',array(
      'followers' => $followers
    ));
  }

  public function recentUserActivityAction(){
    
    return $this->render('juzzUsuariosBundle:Usuarios:recent_user_activity.html.twig');
  }


}
