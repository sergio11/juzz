<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use juzz\UsuariosBundle\Entity\Usuarios AS UsuarioEntity;
use juzz\UsuariosBundle\Entity\Followers AS FollowerEntity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class FollowersController extends Controller{
    
    /**
    * Añade un nuevo follower a $user
    * @ParamConverter("user", options={"mapping": {"user" = "id"}})
    * @ParamConverter("follower", options={"mapping": {"follower" = "id"}})
    */
    public function addAction(UsuarioEntity $user, UsuarioEntity $follower){
        
        $flashBag = $this->get('ras_flash_alert.alert_reporter');
        
         if(!$user->getFollowers()->contains($follower)){
             $em = $this->getDoctrine()->getManager();
             $follow = new FollowerEntity();
             $follow->setDate(new \DateTime('now'));
             $follow->setFollowing($user);
             $follow->setFollower($follower);
             $em->persist($follow);
             $em->flush();
             $flashBag->addSuccess("Ahora sigues a {$user->getFullName()}");
         }else{
             $flashBag->addSuccess("Ya eres seguidor de {$user->getFullName()}");
         }
         
         return $this->redirectToRoute('perfil', array('user' => $user->getNick()));

    }
    
    
    /**
    * Elimina a $follower de la lista de seguidores de $user
    */
    public function deleteAction($user,$follower){
        
        $em = $this->getDoctrine()->getManager();
        $follower = $em->getRepository('juzzUsuariosBundle:Followers')->findOneBy(array(
            'following' => $user,
            'follower' => $follower
        ));
        $em->remove($follower);
        $em->flush();
        $this->get('ras_flash_alert.alert_reporter')->addSuccess("Ahora ya no sigues a {$follower->getFollowing()->getFullName()} ");
        return $this->redirectToRoute('perfil', array('user' => $follower->getFollowing()->getNick()));
    }
    
    /**
    * Devuelve los últimos 5 followers para $user
    * @ParamConverter("user", options={"mapping": {"user" = "id"}})
    */
    public function lastAction(UsuarioEntity $user){
  
        return $this->render('juzzUsuariosBundle:Usuarios:partials/last_followers.html.twig',array(
            'followers' => $user->getFollowers()
        ));
    }
    
    /**
    * Devuelve todos los seguidores para un usuario.
    * @ParamConverter("user", options={"mapping": {"user" = "id"}})
    */
    public function allAction(UsuarioEntity $user){
       /* try {

			$user->getSeguido();

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

	    }*/
    }
    
}