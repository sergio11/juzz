<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use juzz\UsuariosBundle\Entity\Usuarios AS UsuarioEntity;
use juzz\FilesBundle\Entity\Imagenes AS ImagenEntity;
use juzz\UsuariosBundle\Form\UsuarioRegistroType;

class ProfileController extends Controller
{
    /**
     * Show the user
     */
    public function showAction(Request $request,$user)
    {

        if (empty($user)) {
            //Usuario actual que ha iniciado sesión.
            $user = $this->getUser();
        }else{
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('juzzUsuariosBundle:Usuarios')->findOneBy(array('nick' => $user));
            //Si no existe el usuario lanzamos 404
            if (!$user) {
                throw $this->createNotFoundException();
            }
        }

        return $this->render('juzzUsuariosBundle:Usuarios:profile.html.twig',array(
            'name' => $user->getNombre(),
            'apellidos' => $user->getApellidos(),
            'avatar' => $user->getAvatar()->getWebPath()
        ));
    }
    /**
     * Edit the user
     */
    public function editAction(Request $request,$user)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('juzzUsuariosBundle:Usuarios')->findOneBy(array('nick' => $user));
        //Si no existe el usuario lanzamos 404
        if (!$user) {
            throw $this->createNotFoundException();
        }
        //Si el usuario de la sesión no es el propietario del perfil.
        if ($this->getUser()->getNick() != $user->getNick()) {
            throw $this->createAccessDeniedException();
        }
        /*$form = $this->createForm(new UsuarioRegistroType(), $user);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($user);
            $em->flush();
        }*/
        return $this->render('juzzUsuariosBundle:PrivateZone:edit_profile.html.twig');
        
    }
}