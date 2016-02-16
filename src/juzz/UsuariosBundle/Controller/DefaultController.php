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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

class DefaultController extends Controller
{

  /**
  * @Cache(expires="tomorrow", public=true)
  */
  public function indexAction(Request $request)
  {
    $repository = $this->getDoctrine()->getRepository('juzzEpisodiosBundle:Categorias');
    $categories = $repository->findBy(
		  array('parent'  => null)
		);

    return $this->render(':default:index.html.twig',array(
      'categories' => $categories
    ));

  }

    
  public function recentUserActivityAction(){
    
    return $this->render('juzzUsuariosBundle:Usuarios:recent_user_activity.html.twig');
  }


}
