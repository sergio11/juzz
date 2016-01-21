<?php

namespace juzz\CommentsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * Comentarios
 *
 * @ORM\Table(name="comentarios", indexes={@ORM\Index(name="COM_PAR_FK", columns={"parent_id"}), @ORM\Index(name="COM_PRO_FK", columns={"propietario_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="juzz\CommentsBundle\Entity\CommentsRepository")
 * @ExclusionPolicy("all")
 */
class Comentarios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Expose
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     * @Expose
     * @SerializedName("datetime")
     */
    private $fecha;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valido", type="boolean", nullable=false)
     */
    private $valido = true;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", nullable=false)
     * @Expose
     * @SerializedName("text")
     */
    private $contenido;

    /**
     * @var integer
     *
     * @ORM\Column(name="target", type="bigint", nullable=false)
     * @Expose
     */
    private $target;

    /**
     * @var \Comentarios
     *
     * @ORM\ManyToOne(targetEntity="\juzz\CommentsBundle\Entity\Comentarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     * @Expose
     * @MaxDepth(1)
     */
    private $parent;


    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="\juzz\UsuariosBundle\Entity\Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="propietario_id", referencedColumnName="id")
     * })
     * @Expose
     * @SerializedName("owner")
     * @MaxDepth(1)
     */
    private $propietario;

    /**
    *  @var \Comentarios
    *  @ORM\OneToMany(targetEntity="juzz\CommentsBundle\Entity\Comentarios", mappedBy="parent", cascade={"remove"})
    *  @Expose
    */

    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="AssessComment", mappedBy="comment", cascade={"persist","remove"})
     * @Expose
     * @SerializedName("assess")
     * @MaxDepth(1)
     */
    private $assess;

    function __construct()
    {

        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->assess = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Comentarios
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set valido
     *
     * @param boolean $valido
     * @return Comentarios
     */
    public function setValido($valido)
    {
        $this->valido = $valido;

        return $this;
    }

    /**
     * Get valido
     *
     * @return boolean 
     */
    public function getValido()
    {
        return $this->valido;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     * @return Comentarios
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string 
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set target
     *
     * @param integer $target
     * @return Comentarios
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return integer 
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set parent
     *
     * @param \juzz\EpisodiosBundle\Entity\Comentarios $parent
     * @return Comentarios
     */
    public function setParent(\juzz\CommentsBundle\Entity\Comentarios $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \juzz\EpisodiosBundle\Entity\Comentarios 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set propietario
     *
     * @param \juzz\UsuariosBundle\Entity\Usuarios $propietario
     * @return Comentarios
     */
    public function setPropietario(\juzz\UsuariosBundle\Entity\Usuarios $propietario = null)
    {
        $this->propietario = $propietario;

        return $this;
    }

    public function getComments()
    {
        return $this->comments->toArray();
    }

    public function addComment(\juzz\CommentsBundle\Entity\Comentarios $comment)
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
        }

        return $this;
    }

    public function removeComment(\juzz\CommentsBundle\Entity\Comentarios $comment)
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
        }

        return $this;
    }

    /**
     * Add Like o Dislike
     *
     * @param \juzz\CommentsBundle\Entity\AssessComment $usuario
     * @return Comentario
     */
    public function addAssess(\juzz\CommentsBundle\Entity\AssessComment $assess)
    {
    
        $this->assess[] = $assess;
        
        return $this;
    }

    /**
     * Remove like or dislike 
     *
     * @param \juzz\UsuariosBundle\Entity\Usuarios $usuario
     */
    public function removeAssess(\juzz\CommentsBundle\Entity\AssessComment $assess)
    {
        $this->assess->removeElement($assess);
    }

    /**
    *  Update Assess
    *
    **/
    public function updateAssess($key, $newAssess)
    {   

        $this->assess->set($key, $newAssess);

        return $this->assess->get($key);
    }

    /**
     * Get Likes Dislikes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAssess()
    {
        return $this->assess;
    }



}
