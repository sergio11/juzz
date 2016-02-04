<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use juzz\UsuariosBundle\Entity\Usuarios AS UsuarioEntity;
use juzz\UsuariosBundle\Form\UserEditType;
use juzz\UsuariosBundle\Form\UserChangeEmailType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ProfileController extends Controller
{
    /**
     * Show the user
     * @ParamConverter("user", options={"mapping": {"user" = "nick"}})
     */
    public function showAction(Request $request, UsuarioEntity $user)
    {

        /*if($this->getUser()->getId() != $user->getId()){
           $pusher = $this->container->get('lopi_pusher.pusher');
           $serializer = $this->get('jms_serializer');
           $message = array(
              'name' => $this->getUser()->getNombreCompleto(),
              'avatar' => $this->getUser()->getAvatar()->getWebPath(),
              'profile' => $this->generateUrl('perfil',array('user' => $this->getUser()->getNick()))
           );
           $pusher->trigger( 'my-channel', 'profile_visited', $serializer->serialize($message, 'json'));
        }*/
        //Renderizamos página de perfil con la información del propietario.
        return $this->render('juzzUsuariosBundle:Usuarios:tab-profile.html.twig',array(
            'owner' => $user
        ));
    }
    /**
     * Edit the user
     * @ParamConverter("user", options={"mapping": {"user" = "nick"}})
     */
    public function editAction(Request $request, UsuarioEntity $user)
    {
        
        //Si el usuario de la sesión no es el propietario del perfil.
        if ($this->getUser()->getNick() != $user->getNick()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(new UserEditType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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