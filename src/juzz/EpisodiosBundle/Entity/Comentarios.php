<?php

namespace juzz\EpisodiosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comentarios
 *
 * @ORM\Table(name="comentarios", indexes={@ORM\Index(name="COM_PAR_FK", columns={"parent_id"}), @ORM\Index(name="COM_PRO_FK", columns={"propietario_id"})})
 * @ORM\Entity
 */
class Comentarios
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
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valido", type="boolean", nullable=false)
     */
    private $valido = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", length=16777215, nullable=false)
     */
    private $contenido;

    /**
     * @var integer
     *
     * @ORM\Column(name="target", type="bigint", nullable=false)
     */
    private $target;

    /**
     * @var \Comentarios
     *
     * @ORM\ManyToOne(targetEntity="Comentarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="\juzz\UsuariosBundle\Entity\Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="propietario_id", referencedColumnName="id")
     * })
     */
    private $propietario;



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
     *
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
     *
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
     *
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
     * @param \juzz\juzzBundle\Entity\Comentarios $parent
     *
     * @return Comentarios
     */
    public function setParent(\juzz\juzzBundle\Entity\Comentarios $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \juzz\juzzBundle\Entity\Comentarios
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set propietario
     *
     * @param \juzz\juzzBundle\Entity\Usuarios $propietario
     *
     * @return Comentarios
     */
    public function setPropietario(\juzz\juzzBundle\Entity\Usuarios $propietario = null)
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * Get propietario
     *
     * @return \juzz\juzzBundle\Entity\Usuarios
     */
    public function getPropietario()
    {
        return $this->propietario;
    }
}
