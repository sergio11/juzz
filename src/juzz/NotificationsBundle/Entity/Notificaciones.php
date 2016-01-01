<?php

namespace juzz\NotificationsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * Notificaciones
 *
 * @ORM\Table(name="notificaciones", indexes={@ORM\Index(name="TAR_FK", columns={"target_id"}), @ORM\Index(name="SOUR_FK", columns={"source"})})
 * @ORM\Entity
 * @ExclusionPolicy("all")
 */
class Notificaciones
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
     * @SerializedName("data")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=false)
     * @Expose
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vista", type="boolean", nullable=false)
     */
    private $vista;

    /**
     * @var integer
     *
     * @ORM\Column(name="objetive", type="bigint", nullable=false)
     * 
     */
    private $objetive;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="juzz\UsuariosBundle\Entity\Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="source", referencedColumnName="id")
     * })
     * @Expose
     * @MaxDepth(1)
     * @SerializedName("user")
     *
     */
    private $source;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="juzz\UsuariosBundle\Entity\Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="target_id", referencedColumnName="id")
     * })
     */
    private $target;

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Notificaciones
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
     * Set type
     *
     * @param string $type
     * @return Notificaciones
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return strtoupper($this->type);
    }

    /**
     * Set vista
     *
     * @param boolean $vista
     * @return Notificaciones
     */
    public function setVista($vista)
    {
        $this->vista = $vista;

        return $this;
    }

    /**
     * Get vista
     *
     * @return boolean 
     */
    public function getVista()
    {
        return $this->vista;
    }

    /**
     * Set objetive
     *
     * @param integer $objetive
     * @return Notificaciones
     */
    public function setObjetive($objetive)
    {
        $this->objetive = $objetive;

        return $this;
    }

    /**
     * Get objetive
     *
     * @return integer 
     */
    public function getObjetive()
    {
        return $this->objetive;
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
     * Set target
     *
     * @param \juzz\DoctrineMetadaBundle\Entity\Usuarios $target
     * @return Notificaciones
     */
    public function setTarget(\juzz\DoctrineMetadaBundle\Entity\Usuarios $target = null)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return \juzz\DoctrineMetadaBundle\Entity\Usuarios 
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set source
     *
     * @param \juzz\DoctrineMetadaBundle\Entity\Usuarios $source
     * @return Notificaciones
     */
    public function setSource(\juzz\DoctrineMetadaBundle\Entity\Usuarios $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return \juzz\DoctrineMetadaBundle\Entity\Usuarios 
     */
    public function getSource()
    {
        return $this->source;
    }
}
