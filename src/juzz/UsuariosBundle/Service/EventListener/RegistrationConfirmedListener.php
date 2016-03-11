<?php
namespace juzz\UsuariosBundle\Service\EventListener;

use juzz\UsuariosBundle\UsuariosBundleEvents;
use juzz\UsuariosBundle\Event\RegistrationConfirmedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Translation\Translator;

class RegistrationConfirmedListener implements EventSubscriberInterface
{
	private $router;
	private $token_storage;
    private $translator;
    private $reporter;

	public function __construct(UrlGeneratorInterface $router, TokenStorageInterface $token_storage, Translator $translator, $reporter)
	{
		$this->router = $router;
		$this->token_storage = $token_storage;
        $this->translator = $translator;
        $this->reporter = $reporter;
	}

	public static function getSubscribedEvents()
    {
        return array(
            UsuariosBundleEvents::REGISTRATION_CONFIRM => 'onRegistrationConfirmed'
        );
    }

    public function onRegistrationConfirmed(RegistrationConfirmedEvent $event){

    	$user = $event->getUser();
        $translated = $this->translator->trans('registration.confirmed',array(
                '%username%' => $user->getFullName()
            ),'juzzUsuariosBundle');
        // Crear un mensaje flash para notificar al usuario que su cuenta ha sido activada con éxito.
        $this->reporter->addSuccess($translated);
    	// Loguear al usuario automáticamente
        $token = new UsernamePasswordToken($user, $user->getPassword(), 'main', $user->getRoles());
    	$this->token_storage->setToken($token);
    	$url = $this->router->generate('perfil',array('user' => $user->getNick() ));
        $event->setResponse(new RedirectResponse($url));
 
    }


}