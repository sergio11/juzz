<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use juzz\UsuariosBundle\Entity\Usuarios AS UsuarioEntity;
use juzz\FilesBundle\Entity\Imagenes AS ImagenEntity;
use juzz\UsuariosBundle\Form\UserEditType;
use juzz\UsuariosBundle\Form\UserChangeEmailType;
use juzz\FilesBundle\Form\ProfileBackgroundType;

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

            if($this->getUser()->getId() != $user->getId()){
                $pusher = $this->container->get('lopi_pusher.pusher');
                $serializer = $this->get('jms_serializer');
                $message = array(
                    'name' => $this->getUser()->getNombreCompleto(),
                    'avatar' => $this->getUser()->getAvatar()->getWebPath(),
                    'profile' => $this->generateUrl('perfil',array('user' => $this->getUser()->getNick()))
                );
                $pusher->trigger( 'my-channel', 'profile_visited', $serializer->serialize($message, 'json'));
            }
            
        }
        //Renderizamos página de perfil con la información del propietario.
        return $this->render('juzzUsuariosBundle:Usuarios:profile.html.twig',array(
            'owner' => $user
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
            throw $this->createNotFoundException("El usuario no existe");
        }
        //Si el usuario de la sesión no es el propietario del perfil.
        if ($this->getUser()->getNick() != $user->getNick()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(new UserEditType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($user);
            $em->flush();
            $this->get('ras_flash_alert.alert_reporter')->addSuccess('Cambios Guardados con Éxito');
        }

        $changeEmailForm = $this->createForm(new UserChangeEmailType());

        return $this->render('juzzUsuariosBundle:PrivateZone:edit-profile.html.twig', array(
            'user'      => $user,
            'edit_form'   => $form->createView(),
            'change_email_form' => $changeEmailForm->createView()
        ));   
    }


    public function myCommentsAction(Request $request,$user){
        $start = $request->query->getInt('start',0);
        $count = $request->query->getInt('count',10);
        /*try {

            $em = $this->getDoctrine()->getManager();
            //Obtenemos el conjunto de comentarios para el target especificado.
            $posts = $em->getRepository('juzzCommentsBundle:Comentarios')
                    ->getComments($target,$start,$count);
        }catch(Exception $e){

            
        }*/
        return $this->render('juzzUsuariosBundle:PrivateZone:my-comments.html.twig');
    }



}