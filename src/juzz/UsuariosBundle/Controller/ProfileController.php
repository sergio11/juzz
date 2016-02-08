<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use juzz\UsuariosBundle\Entity\Usuarios AS UsuarioEntity;
use juzz\UsuariosBundle\Form\UserEditType;
use juzz\UsuariosBundle\Form\UserChangeEmailType;
use juzz\UsuariosBundle\Form\LowProcessType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use JMS\SecurityExtraBundle\Annotation\SecureParam;

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
        return $this->render('juzzUsuariosBundle:Usuarios:public/tab-profile.html.twig',array(
            'owner' => $user
        ));
    }
    /**
     * Edit the user
     * @ParamConverter("user", options={"mapping": {"user" = "nick"}})
     * @SecureParam(name="user", permissions="EDIT")
     */
    public function editAction(Request $request, UsuarioEntity $user)
    {
        
        $form = $this->createForm(new UserEditType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->get('ras_flash_alert.alert_reporter')->addSuccess('Cambios Guardados con Éxito');
        }

        $changeEmailForm = $this->createForm(new UserChangeEmailType());

        return $this->render('juzzUsuariosBundle:Usuarios:private/edit-profile.html.twig', array(
            'user'      => $user,
            'edit_form'   => $form->createView(),
            'change_email_form' => $changeEmailForm->createView()
        ));   
    }

    /**
    * Delete User Account
    * @ParamConverter("user", options={"mapping": {"user" = "nick"}})
    */
    public function deleteAction(Request $request,UsuarioEntity $user){
      $form = $this->createForm(new LowProcessType());
      $form->handleRequest($request);
      if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        //invalidamos la sesión.
        $this->get('session')->invalidate();
        //redirigimos a la portada.
        return $this->redirect($this->generateUrl('portada'));
      }
      
      return $this->render('juzzUsuariosBundle:Usuarios:private/low-process.html.twig',array(
        'form' => $form->createView(),
        'user' => $user
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
        return $this->render('juzzUsuariosBundle:Usuarios:private/my-comments.html.twig');
    }



}