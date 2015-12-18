<?php

namespace juzz\CommentsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use juzz\CommentsBundle\Entity\Comentarios AS Comment;
use juzz\CommentsBundle\Entity\AssessComment AS AssessComment;

class CommentsController extends Controller
{

	public function getPostsAction(Request $request,$target){

        $start = $request->query->getInt('start',0);
        $count = $request->query->getInt('count',10);

		try {

			$em = $this->getDoctrine()->getManager();
			//Obtenemos el conjunto de comentarios para el target especificado.
            $posts = $em->getRepository('juzzCommentsBundle:Comentarios')
                    ->getComments($target,$start,$count);

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
        //recogemos datos de la petición.
        $data = $request->request->get('data');

        try {

            $em = $this->getDoctrine()->getManager();

            $comment = new Comment();
            $comment->setFecha(new \DateTime('now'));
            $comment->setContenido($data['content']);
            $comment->setTarget($data['target']);
            $parent = null;
            if (isset($data['parent']) && is_numeric($data['parent'])) {
                $parent = $em->getRepository('juzzCommentsBundle:Comentarios')->find($data['parent']);
            }
            $comment->setParent($parent);
            $owner = null;
            if (isset($data['owner']) && is_numeric($data['owner'])) {
                $owner = $em->getRepository('juzzUsuariosBundle:Usuarios')->find($data['owner']);
            }
            $comment->setPropietario($owner);
            $comment->setValido(true);
            //Validamos entidad.
            $validator = $this->get('validator'); 
            $errors = $validator->validate($comment); 
            if(count($errors)==0){ 
                
                $em->persist($comment); 
                $em->flush(); 

                $serializer = $this->get('jms_serializer');

                $response = $serializer->serialize([
                    'success' => true,
                    'data'    => $comment
                ], 'json');


            }else{ 
                $response = array(
                    'success' => false,
                    'message' => "Post inválido"
                );
            } 

            return new JsonResponse($response);



        } catch (\Exception $exception) {

            return new JsonResponse([
                'success' => false,
                'code'    => $exception->getCode(),
                'message' => $exception->getMessage(),
            ]);

        }

    }

    public function assessAction(Request $request,$target){
        //recogemos datos de la petición.
        $data = $request->request->get('data');

        try {

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('juzzUsuariosBundle:Usuarios')->find($data['user']);
            $comment = $em->getRepository('juzzCommentsBundle:Comentarios')->find($data['comment']);
            
            if(!$comment || !$user){
                throw $this->createNotFoundException();
            }

            $assess = new AssessComment();
            $assess->setUser($user);
            $assess->setComment($comment);
            $assess->setAssess($data['value']);
            $assess->setDate(new \DateTime('now'));

            $comment->addAssess($assess);

            $em->persist($comment);
            $em->flush();

            $serializer = $this->get('jms_serializer');

            $response = $serializer->serialize([
                'success' => true,
                'data'    => $assess
            ], 'json');

            return new JsonResponse($response);
            
        } catch (Exception $e) {
            return new JsonResponse([
                'success' => false,
                'code'    => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
        return new JsonResponse([
            'data' => $data
        ]);
 
    }


    public function commentsWallAction($target)
    {
        $user = $this->getUser();
        return $this->render('juzzCommentsBundle:Default:comments-wall.html.twig',array(
        	'comments' => array(),
            'target' => $target,
            'user' => $user->getUserInformationSummary()
        ));
    }
}
