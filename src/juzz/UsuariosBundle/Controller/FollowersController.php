<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use juzz\UsuariosBundle\Entity\Usuarios AS UsuarioEntity;
use juzz\UsuariosBundle\Entity\Followers AS FollowerEntity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

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
    * @Cache(expires="tomorrow")
    */
    public function lastAction(UsuarioEntity $user){
  
        return $this->render('juzzUsuariosBundle:Usuarios:public/partials/last_followers.html.twig',array(
            'followers' => $user->getFollowers(),
            'owner_nick' => $user->getNick()
        ));
    }
    
    /**
    * Devuelve todos los seguidores para un usuario.
    * @ParamConverter("user", options={"mapping": {"user" = "nick"}})
    * @Cache(expires="tomorrow")
    */
    public function showAction(UsuarioEntity $user){
       return $this->render('juzzUsuariosBundle:Usuarios:public/tab-followers.html.twig',array(
           'owner' => $user
       ));
    }
    
}