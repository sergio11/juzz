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

class DefaultController extends Controller
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


    //Muestra el formulario de Login.
    public function loginAction(Request $request)
    {
      
      $sesion = $request->getSession();
      $error = $request->attributes->get(
        SecurityContext::AUTHENTICATION_ERROR,
        $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
      );

      return $this->render('juzzUsuariosBundle:Accounts:login.html.twig',array(
        'last_email' => $sesion->get(SecurityContext::LAST_USERNAME),
        'error' => $error
      ));

    }

  




  public function followersAction(Request $request,$user){

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
      'followers' => $followers,
      'user' => $user
    ));
  }

  public function recentUserActivityAction(){
    
    return $this->render('juzzUsuariosBundle:Usuarios:recent_user_activity.html.twig');
  }


}
