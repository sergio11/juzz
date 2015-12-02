<?php

namespace juzz\UsuariosBundle\Entity;
 
use Doctrine\ORM\EntityRepository;
 
class PaisesRepository extends EntityRepository
{
    public function getAllCountries()
    {
        return $this->getEntityManager()
            ->createQueryBuilder('f')->select('*');
    }
}