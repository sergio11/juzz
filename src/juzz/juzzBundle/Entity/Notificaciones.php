<?php

namespace juzz\juzzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notificaciones
 *
 * @ORM\Table(name="notificaciones", indexes={@ORM\Index(name="NOT_FK", columns={"target_id"})})
 * @ORM\Entity
 */
class Notificaciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", nullable=false)
     */
    private $tipo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vista", type="boolean", nullable=false)
     */
    private $vista = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="fuente", type="bigint", nullable=false)
     */
    private $fuente;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="target_id", referencedColumnName="id")
     * })
     */
    private $target;



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
     *
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Notificaciones
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set vista
     *
     * @param boolean $vista
     *
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
     * Set fuente
     *
     * @param integer $fuente
     *
     * @return Notificaciones
     */
    public function setFuente($fuente)
    {
        $this->fuente = $fuente;

        return $this;
    }

    /**
     * Get fuente
     *
     * @return integer
     */
    public function getFuente()
    {
        return $this->fuente;
    }

    /**
     * Set target
     *
     * @param \juzz\juzzBundle\Entity\Usuarios $target
     *
     * @return Notificaciones
     */
    public function setTarget(\juzz\juzzBundle\Entity\Usuarios $target = null)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return \juzz\juzzBundle\Entity\Usuarios
     */
    public function getTarget()
    {
        return $this->target;
    }
}
