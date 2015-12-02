<?php

namespace juzz\DoctrineMetadaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActividadesUsuarios
 *
 * @ORM\Table(name="actividades_usuarios", indexes={@ORM\Index(name="ACTU_FK", columns={"usuario_id"})})
 * @ORM\Entity
 */
class ActividadesUsuarios
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
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;



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
     * @return ActividadesUsuarios
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
     * @return ActividadesUsuarios
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
     * Set usuario
     *
     * @param \juzz\DoctrineMetadaBundle\Entity\Usuarios $usuario
     * @return ActividadesUsuarios
     */
    public function setUsuario(\juzz\DoctrineMetadaBundle\Entity\Usuarios $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \juzz\DoctrineMetadaBundle\Entity\Usuarios 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
