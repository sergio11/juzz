<?php
namespace juzz\UsuariosBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Response;
use juzz\UsuariosBundle\Entity\Usuarios AS UserEntity;

class RegistrationConfirmedEvent extends Event
{

	private $user;
	private $response;

	public function __construct(UserEntity $user)
    {
        $this->user = $user;
    }

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