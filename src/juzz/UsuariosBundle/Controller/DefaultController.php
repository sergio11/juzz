<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
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
}
