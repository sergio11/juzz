<?php

namespace juzz\UsuariosBundle\Service\Mailer;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use juzz\UsuariosBundle\Entity\Usuarios as UserEntity;
use Hip\MandrillBundle\Message;
use Hip\MandrillBundle\Dispatcher;

class Mailer implements MailerInterface
{
    protected $dispatcher;
    protected $router;
    protected $templating;
    protected $parameters;
    protected $logger;

    public function __construct(Dispatcher $dispatcher, UrlGeneratorInterface  $router, EngineInterface $templating, $logger = null,array $parameters)
    {
        $this->dispatcher = $dispatcher;
        $this->router = $router;
        $this->templating = $templating;
        $this->logger = $logger;
        $this->parameters = $parameters;
    }
    /**
     * {@inheritdoc}
     */
    public function sendConfirmationEmailMessage(UserEntity $user)
    {
        $template = $this->parameters['confirmation.template'];
        $url = $this->router->generate('confirm', array('token' => $user->getConfirmationToken()), UrlGeneratorInterface::ABSOLUTE_URL);
        $rendered = $this->templating->render($template, array(
            'user' => $user,
            'confirmationUrl' =>  $url
        ));
        $this->sendEmailMessage($rendered, $user->getEmail());
    }
    /**
     * {@inheritdoc}
     */
    public function sendResettingEmailMessage(UserEntity $user)
    {
        $template = $this->parameters['resetting.template'];
        $url = $this->router->generate('resetting_reset', array('token' => $user->getConfirmationToken()), UrlGeneratorInterface::ABSOLUTE_URL);
        $rendered = $this->templating->render($template, array(
            'user' => $user,
            'confirmationUrl' => $url
        ));
        $this->sendEmailMessage($rendered, $user->getEmail());
    }
    /**
     * @param string $renderedTemplate
     * @param string $fromEmail
     * @param string $toEmail
     */
    protected function sendEmailMessage($renderedTemplate, $toEmail)
    {
        // Render the email, use the first line as the subject, and the rest as the body
        $renderedLines = explode("\n", trim($renderedTemplate));
        $subject = $renderedLines[0];
        $body = implode("\n", array_slice($renderedLines, 1));
        $message = new Message();
        $message
            ->setFromName('Equipo Juzz')
            ->addTo($toEmail)
            ->setSubject($subject)
            ->setHtml($body);

        $result = $this->dispatcher->send($message);

        $this->logger->info("Result Mail");
        $this->logger->info(print_r($result));
        
    }
}