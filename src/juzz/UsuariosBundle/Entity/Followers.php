<?php

namespace juzz\UsuariosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * 
 *
 * @ORM\Table(name="seguidores")
 * @ORM\Entity
 * @ExclusionPolicy("all")
 */
class Followers
{
   
   /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="\juzz\UsuariosBundle\Entity\Usuarios", inversedBy="followers")
     * @ORM\JoinColumn(name="seguido_id", referencedColumnName="id", nullable=false)
     * @Expose
     * @MaxDepth(1)
     */
    private $following;
    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="\juzz\UsuariosBundle\Entity\Usuarios", inversedBy="following")
     * @ORM\JoinColumn(name="seguidor_id", referencedColumnName="id", nullable=false)
     * @Expose
     * @MaxDepth(1)
     */
    private $follower;
    
    /**
    * @ORM\Column(type="date", name="fecha")
    * @Expose
    */
    private $date;
    /**
    * @ORM\Column(name="bloqueado", type="integer", length=1, nullable=false)
    */
    private $lock = 0;
    
     /**
     * Constructor
     */
    public function __construct()
    {
        $this->follower = new \Doctrine\Common\Collections\ArrayCollection();
        $this->following = new \Doctrine\Common\Collections\ArrayCollection();
       
    }
    
    public function getFollowing(){
        return $this->following;
    }
    
    public function setFollowing(Usuarios $user){
        $this->following = $user;
    }
    
    public function getFollower(){
        return $this->follower;
    }
    
    public function setFollower(Usuarios $user){
        $this->follower = $user;
    }
    
    public function getDate(){
        return $this->date;
    }
    
    public function setDate($data){
        $this->date = $data;
    }
    
    public function isLocked(){
        return $this->lock;
    }
    
    public function setLocked($locked){
        $this->lock = $locked;
    }
    

}