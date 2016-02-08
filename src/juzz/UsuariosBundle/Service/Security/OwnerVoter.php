<?php

namespace juzz\UsuariosBundle\Service\Security;

use juzz\UsuariosBundle\Entity\Usuarios as UserEntity;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class OwnerVoter implements VoterInterface
{
	private $container;

	public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function supportsAttribute($attribute)
    {
        return $attribute == 'EDIT';
    }

    public function supportsClass($class)
    {
        return true;
    }

    public function vote(TokenInterface $token, $object, array $attributes) 
   	{
      
       	foreach ($attributes as $attribute) {
           	if ( !$this->supportsAttribute($attribute) ) {
               return VoterInterface::ACCESS_ABSTAIN;
           	}
       	}

       	$user = $token->getUser();
       	if ( !($user instanceof UserEntity) ) {
           return VoterInterface::ACCESS_DENIED;
       	}

       	if ( $user->equals($object) ) {
           return VoterInterface::ACCESS_GRANTED;
      	}

       return VoterInterface::ACCESS_DENIED;
   	}

}