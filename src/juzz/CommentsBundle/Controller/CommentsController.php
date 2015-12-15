<?php

namespace juzz\CommentsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommentsController extends Controller
{

	public function getPostsAction(Request $request,$target){

        $start = $request->query->getInt('start',0);
        $count = $request->query->getInt('count',10);

		try {

			$em = $this->getDoctrine()->getManager();
			//Obtenemos el conjunto de comentarios para el target especificado.
            $posts = $em->getRepository('juzzCommentsBundle:Comentarios')->findBy(
                array('target' => $target),
                $count,
                $start
            );

            $serializer = $this->get('jms_serializer');

            $response = $serializer->serialize([
            	'success' => true,
            	'data'    => $posts
            ], 'json');

            return new Response($response);


	    } catch (\Exception $exception) {

	        return new JsonResponse([
	            'success' => false,
	            'code'    => $exception->getCode(),
	            'message' => $exception->getMessage(),
	        ]);

	    }
	}

    public function newAction(Request $request){
        $data = $request->request->get('data');

        return new JsonResponse([
            'success' => true,
            'message' => "Post Created !!",
            'post' => $data
        ]);

    }

    public function commentsWallAction($target)
    {
        $user = $this->getUser();
        return $this->render('juzzCommentsBundle:Default:comments-wall.html.twig',array(
        	'comments' => array(),
            'user' => $user->getUserInformationSummary()
        ));
    }
}
