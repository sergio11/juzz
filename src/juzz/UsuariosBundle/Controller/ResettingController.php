<?php

namespace juzz\UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use juzz\UsuariosBundle\UsuariosBundleEvents;
use juzz\UsuariosBundle\Event\ResettingEvent;
use juzz\UsuariosBundle\Form\ResetPasswordType;

class ResettingController extends Controller
{
    /**
     * Envía email para completar reseteo.
     */
    public function sendEmailAction(Request $request)
    {
        $nick = $request->request->get('nick');
        
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("juzzUsuariosBundle:Usuarios")->findOneBy(array(
            'nick' => $nick
        ));
        
        if ($user === null) {
            return $this->render('juzzUsuariosBundle:Accounts:resetting/request.html.twig', array(
                'invalid_username' => $nick
            ));
        }
        //No permitimos solicitud de restablecimiento si esta no ha expirado.
        if ($user->isPasswordRequestNonExpired($this->container->getParameter('juzz_usuarios.resetting.token_ttl'))) {
            return $this->render('juzzUsuariosBundle:Accounts:resetting/passwordAlreadyRequested.html.twig');
        }
        
        if ($user->getConfirmationToken() === null) {
            $tokenGenerator = $this->get('juzz.util.token_generator');
            $user->setConfirmationToken($tokenGenerator->generateToken());
        }
       // $this->get('juzz.mailer')->sendResettingEmailMessage($user);
        $user->setPasswordRequestedAt(new \DateTime());
        $em->flush();
        return $this->redirect($this->generateUrl('resetting_check_email',
            array('email' => $this->getObfuscatedEmail($user))
        ));

    }
    /**
     * Indica al usuario que revise su correo.
     */
    public function checkEmailAction(Request $request)
    {
        $email = $request->query->get('email');
        if (empty($email)) {
            // El usuario no viene desde sendEmail action
            return new RedirectResponse($this->generateUrl('resetting_request'));
        }
        return $this->render('juzzUsuariosBundle:Accounts:resetting/checkEmail.html.twig', array(
            'email' => $email,
        ));
    }
    /**
     * Restablece la contraseña del usuario si es correcta
     */
    public function resetAction(Request $request, $token)
    {
        
        $em = $this->getDoctrine()->getManager();
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');
        //Obtenemos usuario utilizando token
        $user = $em->getRepository('juzzUsuariosBundle:Usuarios')->findOneBy(array(
            'confirmationToken' => $token
        ));
        
        if ($user === null) {
            throw new NotFoundHttpException(sprintf('The user with "confirmation token" does not exist for value "%s"', $token));
        }
        
        $form = $this->createForm(new ResetPasswordType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $encoder = $this->get('security.encoder_factory')->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);
            $user->setConfirmationToken(null);
            $event = new ResettingEvent($form, $user);
            $dispatcher->dispatch(UsuariosBundleEvents::RESETTING_RESET_SUCCESS, $event);
            $em->flush();
            if (null === $response = $event->getResponse()) {
                $translated = $this->get('translator')->trans('resetting.flash.success',array(),'juzzUsuariosBundle');
                //Notificamos que la contraseña fue restablecida con éxito
                $this->get('ras_flash_alert.alert_reporter')->addSuccess($translated);
                $response = $this->redirect($this->generateUrl('perfil',array('user' => $user->getNick())));
            }
            
            return $response;
        }

        return $this->render('juzzUsuariosBundle:Accounts:resetting/reset.html.twig', array(
            'token' => $token,
            'form' => $form->createView(),
        ));
    }
    /**
     * Obtiene el email truncado mostrar
     */
    protected function getObfuscatedEmail($user)
    {
        $email = $user->getEmail();
        if (false !== $pos = strpos($email, '@')) {
            $email = '...' . substr($email, $pos);
        }
        return $email;
    }
}
