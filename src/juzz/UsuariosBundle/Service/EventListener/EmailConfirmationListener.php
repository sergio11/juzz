<?php

namespace juzz\UsuariosBundle\Service\EventListener;

use juzz\UsuariosBundle\UsuariosBundleEvents;
use juzz\UsuariosBundle\Event\RegistrationEvent;
use juzz\UsuariosBundle\Service\Mailer\MailerInterface;
use juzz\UsuariosBundle\Service\Util\TokenGeneratorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EmailConfirmationListener implements EventSubscriberInterface
{
    private $mailer;
    private $tokenGenerator;
    private $router;
    private $session;
    private $logger;
    private $active;
    
    public function __construct(MailerInterface $mailer, TokenGeneratorInterface $tokenGenerator, UrlGeneratorInterface $router, SessionInterface $session, $logger = null)
    {
        $this->mailer = $mailer;
        $this->tokenGenerator = $tokenGenerator;
        $this->router = $router;
        $this->session = $session;
        $this->logger = $logger;
    }

    public function setActive( $active )
    {
        $this->active = $active;
    }
    
    public static function getSubscribedEvents()
    {
        return array(
            UsuariosBundleEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
        );
    }
    
    public function onRegistrationSuccess(RegistrationEvent $event)
    {
        $this->logger->info("Handling RegistrationSuccess Event");
        if($this->active){
            $user = $event->getUser();
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
}