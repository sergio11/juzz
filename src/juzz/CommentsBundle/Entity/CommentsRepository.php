<?php

namespace juzz\CommentsBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class CommentsRepository extends EntityRepository{

	public function getComments($target,$start,$count){
		$query = $this->createQueryBuilder('C')
		    ->where('C.target = :target')
		    ->andWhere('C.parent IS NULL')
		    ->setParameter('target', $target)
		    ->getQuery();

		return $query->getResult();
	}

}

