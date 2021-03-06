<?php

namespace juzz\ProgramasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Programas
 *
 * @ORM\Table(name="programas", indexes={@ORM\Index(name="PRO_FK", columns={"canal_id"})})
 * @ORM\Entity
 */
class Programas
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=60, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creacion", type="date", nullable=false)
     */
    private $creacion;

    /**
     * @var \Canales
     *
     * @ORM\ManyToOne(targetEntity="\juzz\CanalesBundle\Entity\Canales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="canal_id", referencedColumnName="id")
     * })
     */
    private $canal;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="\juzz\UsuariosBundle\Entity\Usuarios", mappedBy="subscripcion")
     */
    private $subscriptor;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="\juzz\UsuariosBundle\Entity\Usuarios", mappedBy="programa")
     */
    private $usuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subscriptor = new \Doctrine\Common\Collections\ArrayCollection();
        $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Programas
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Programas
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     * @return Programas
     */
    public function setCreacion($creacion)
    {
        $this->creacion = $creacion;

        return $this;
    }

    /**
     * Get creacion
     *
     * @return \DateTime 
     */
    public function getCreacion()
    {
        return $this->creacion;
    }

    /**
     * Set canal
     *
     * @param \juzz\CanalesBundle\Entity\Canales $canal
     * @return Programas
     */
    public function setCanal(\juzz\CanalesBundle\Entity\Canales $canal = null)
    {
        $this->canal = $canal;

        return $this;
    }

    /**
     * Get canal
     *
     * @return \juzz\CanalesBundle\Entity\Canales 
     */
    public function getCanal()
    {
        return $this->canal;
    }

    /**
     * Add subscriptor
     *
     * @param \juzz\UsuariosBundle\Entity\Usuarios $subscriptor
     * @return Programas
     */
    public function addSubscriptor(\juzz\UsuariosBundle\Entity\Usuarios $subscriptor)
    {
        $this->subscriptor[] = $subscriptor;

        return $this;
    }

    /**
     * Remove subscriptor
     *
     * @param \juzz\UsuariosBundle\Entity\Usuarios $subscriptor
     */
    public function removeSubscriptor(\juzz\UsuariosBundle\Entity\Usuarios $subscriptor)
    {
        $this->subscriptor->removeElement($subscriptor);
    }

    /**
     * Get subscriptor
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubscriptor()
    {
        return $this->subscriptor;
    }

    /**
     * Add usuario
     *
     * @param \juzz\UsuariosBundle\Entity\Usuarios $usuario
     * @return Programas
     */
    public function addUsuario(\juzz\UsuariosBundle\Entity\Usuarios $usuario)
    {
        $this->usuario[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \juzz\UsuariosBundle\Entity\Usuarios $usuario
     */
    public function removeUsuario(\juzz\UsuariosBundle\Entity\Usuarios $usuario)
    {
        $this->usuario->removeElement($usuario);
    }

    /**
     * Get usuario
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
