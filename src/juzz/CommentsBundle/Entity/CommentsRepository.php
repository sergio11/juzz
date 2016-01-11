<?php

namespace juzz\CommentsBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class CommentsRepository extends EntityRepository{

	public function getComments($target,$start,$count){
		$query = $this->createQueryBuilder('C')
		    ->where('C.target = :target AND C.valido = 1')
		    ->andWhere('C.parent IS NULL')
		    ->orderBy('C.fecha', 'DESC')
		    ->setParameter('target', $target)
		    ->getQuery();

		return $query->getResult();
	}

	public function getAllCommentsSubmitted($user,$start,$count){
		$query = $this->createQueryBuilder('C')
		    ->where('C.owner = :user')
		    ->orderBy('C.fecha', 'DESC')
		    ->setParameter('user', $user)
		    ->getQuery();

		return $query->getResult();
	}

}

