<?php

namespace juzz\UsuariosBundle\EventListener;

use juzz\UsuariosBundle\UsuariosBundleEvents;
use juzz\UsuariosBundle\Event\FormEvent;
use juzz\UsuariosBundle\Mailer\MailerInterface;
use juzz\UsuariosBundle\Util\TokenGeneratorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class EmailConfirmationListener implements EventSubscriberInterface
{
    private $mailer;
    private $tokenGenerator;
    private $router;
    private $session;
    
    public function __construct(MailerInterface $mailer, TokenGeneratorInterface $tokenGenerator, UrlGeneratorInterface $router, SessionInterface $session)
    {
        $this->mailer = $mailer;
        $this->tokenGenerator = $tokenGenerator;
        $this->router = $router;
        $this->session = $session;
    }
    
    public static function getSubscribedEvents()
    {
        return array(
            UsuariosBundleEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }
    
    public function onRegistrationSuccess(FormEvent $event)
    {
        /** @var $user \FOS\UserBundle\Model\UserInterface */
        $user = $event->getForm()->getData();
        $user->setActivo(0);
        if (null === $user->getConfirmationToken()) {
            $user->setConfirmationToken($this->tokenGenerator->generateToken());
        }
        $this->mailer->sendConfirmationEmailMessage($user);
        $this->session->set('juzz_user_send_confirmation_email/email', $user->getEmail());
        $url = $this->router->generate('check_email');
        $event->setResponse(new RedirectResponse($url));
    }
}