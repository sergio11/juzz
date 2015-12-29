<?php

namespace juzz\CommentsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * AssessComment
 *
 * @ORM\Table(name="comments_assess", indexes={@ORM\Index(name="ASSCOM_PK", columns={"user","comment"}), @ORM\Index(name="ASS_USU_FK", columns={"user"}) , @ORM\Index(name="ASS_COM_FK", columns={"comment"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="juzz\CommentsBundle\Entity\CommentsRepository")
 * @ExclusionPolicy("all")
 */
class AssessComment
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="\juzz\UsuariosBundle\Entity\Usuarios", inversedBy="assess", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * })
     * 
     * 
     */
    private $user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="\juzz\CommentsBundle\Entity\Comentarios", inversedBy="assess", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="comment", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * })
     * 
     */
    private $comment;

    // Atributos propios
    /**
     * @var tinyint
     *
     * @ORM\Column(columnDefinition="TINYINT DEFAULT 0 NOT NULL")
     *
     * @Expose
     * @SerializedName("assess")
     */
    private $assess;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     * @Expose
     * @SerializedName("date")
     */

    private $date;

    /**
     * Get User
     *
     * @return \juzz\UsuariosBundle\Entity\Usuarios 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set User
     *
     * @param \juzz\UsuariosBundle\Entity\Usuarios $user
     * @return AssessComment
     */
    public function setUser(\juzz\UsuariosBundle\Entity\Usuarios $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get Comment
     *
     * @return \juzz\CommentsBundle\Entity\Comentarios 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set Comment
     *
     * @param \juzz\CommentsBundle\Entity\Comentarios  $comment
     * @return AssessComment
     *
     */
    public function setComment(\juzz\CommentsBundle\Entity\Comentarios $comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    public function setAssess($assess){

        $this->assess = $assess;

        return $this;
    }

    public function getAssess(){

        return $this->assess;
    }
    

    /**
     * Set Date
     *
     * @param \DateTime $date
     * @return AssessComment
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get Date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

}