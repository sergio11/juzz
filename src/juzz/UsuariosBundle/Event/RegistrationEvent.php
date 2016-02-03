<?php
namespace juzz\UsuariosBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use juzz\UsuariosBundle\Entity\Usuarios AS UserEntity;

class RegistrationEvent extends Event
{
    private $form;
    private $user;
    private $response;

    public function __construct(FormInterface $form, UserEntity $user)
    {
        $this->form = $form;
        $this->user = $user;
    }
    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }
    /**
     * @return Request
     */
    public function getUser()
    {
        return $this->user;
    }
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }
    /**
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }
}