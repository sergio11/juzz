<?php

namespace juzz\juzzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios", uniqueConstraints={@ORM\UniqueConstraint(name="USU_EMA_UK", columns={"email"})})
 * @ORM\Entity
 */
class Usuarios
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
     * @ORM\Column(name="nombre", type="string", length=30, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ape1", type="string", length=30, nullable=false)
     */
    private $ape1;

    /**
     * @var string
     *
     * @ORM\Column(name="ape2", type="string", length=30, nullable=false)
     */
    private $ape2;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=90, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60, nullable=false)
     */
    private $password;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ingreso", type="date", nullable=false)
     */
    private $ingreso;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Categorias", inversedBy="usuario")
     * @ORM\JoinTable(name="categorias_usuarios",
     *   joinColumns={
     *     @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="categoria_id", referencedColumnName="termino_id")
     *   }
     * )
     */
    private $categoria;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Programas", inversedBy="subscriptor")
     * @ORM\JoinTable(name="likes_programas",
     *   joinColumns={
     *     @ORM\JoinColumn(name="subscriptor_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="subscripcion_id", referencedColumnName="id")
     *   }
     * )
     */
    private $subscripcion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Usuarios", mappedBy="seguidor")
     */
    private $seguido;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Programas", inversedBy="usuario")
     * @ORM\JoinTable(name="subscripciones_programas",
     *   joinColumns={
     *     @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="programa_id", referencedColumnName="id")
     *   }
     * )
     */
    private $programa;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categoria = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subscripcion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->seguido = new \Doctrine\Common\Collections\ArrayCollection();
        $this->programa = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
     * @return Usuarios
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
     * Set ape1
     *
     * @param string $ape1
     *
     * @return Usuarios
     */
    public function setApe1($ape1)
    {
        $this->ape1 = $ape1;

        return $this;
    }

    /**
     * Get ape1
     *
     * @return string
     */
    public function getApe1()
    {
        return $this->ape1;
    }

    /**
     * Set ape2
     *
     * @param string $ape2
     *
     * @return Usuarios
     */
    public function setApe2($ape2)
    {
        $this->ape2 = $ape2;

        return $this;
    }

    /**
     * Get ape2
     *
     * @return string
     */
    public function getApe2()
    {
        return $this->ape2;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Usuarios
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuarios
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Usuarios
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set ingreso
     *
     * @param \DateTime $ingreso
     *
     * @return Usuarios
     */
    public function setIngreso($ingreso)
    {
        $this->ingreso = $ingreso;

        return $this;
    }

    /**
     * Get ingreso
     *
     * @return \DateTime
     */
    public function getIngreso()
    {
        return $this->ingreso;
    }

    /**
     * Add categorium
     *
     * @param \juzz\juzzBundle\Entity\Categorias $categorium
     *
     * @return Usuarios
     */
    public function addCategorium(\juzz\juzzBundle\Entity\Categorias $categorium)
    {
        $this->categoria[] = $categorium;

        return $this;
    }

    /**
     * Remove categorium
     *
     * @param \juzz\juzzBundle\Entity\Categorias $categorium
     */
    public function removeCategorium(\juzz\juzzBundle\Entity\Categorias $categorium)
    {
        $this->categoria->removeElement($categorium);
    }

    /**
     * Get categoria
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Add subscripcion
     *
     * @param \juzz\juzzBundle\Entity\Programas $subscripcion
     *
     * @return Usuarios
     */
    public function addSubscripcion(\juzz\juzzBundle\Entity\Programas $subscripcion)
    {
        $this->subscripcion[] = $subscripcion;

        return $this;
    }

    /**
     * Remove subscripcion
     *
     * @param \juzz\juzzBundle\Entity\Programas $subscripcion
     */
    public function removeSubscripcion(\juzz\juzzBundle\Entity\Programas $subscripcion)
    {
        $this->subscripcion->removeElement($subscripcion);
    }

    /**
     * Get subscripcion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscripcion()
    {
        return $this->subscripcion;
    }

    /**
     * Add seguido
     *
     * @param \juzz\juzzBundle\Entity\Usuarios $seguido
     *
     * @return Usuarios
     */
    public function addSeguido(\juzz\juzzBundle\Entity\Usuarios $seguido)
    {
        $this->seguido[] = $seguido;

        return $this;
    }

    /**
     * Remove seguido
     *
     * @param \juzz\juzzBundle\Entity\Usuarios $seguido
     */
    public function removeSeguido(\juzz\juzzBundle\Entity\Usuarios $seguido)
    {
        $this->seguido->removeElement($seguido);
    }

    /**
     * Get seguido
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeguido()
    {
        return $this->seguido;
    }

    /**
     * Add programa
     *
     * @param \juzz\juzzBundle\Entity\Programas $programa
     *
     * @return Usuarios
     */
    public function addPrograma(\juzz\juzzBundle\Entity\Programas $programa)
    {
        $this->programa[] = $programa;

        return $this;
    }

    /**
     * Remove programa
     *
     * @param \juzz\juzzBundle\Entity\Programas $programa
     */
    public function removePrograma(\juzz\juzzBundle\Entity\Programas $programa)
    {
        $this->programa->removeElement($programa);
    }

    /**
     * Get programa
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrograma()
    {
        return $this->programa;
    }
}
