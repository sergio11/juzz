<?php

namespace juzz\DoctrineMetadaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios", uniqueConstraints={@ORM\UniqueConstraint(name="USU_EMA_UK", columns={"email"})}, indexes={@ORM\Index(name="USU_AVA_FK", columns={"avatar"}), @ORM\Index(name="USU_PRO_FK", columns={"profile_bg"})})
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
    private $activo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ingreso", type="date", nullable=false)
     */
    private $ingreso;

    /**
     * @var \Imagenes
     *
     * @ORM\ManyToOne(targetEntity="Imagenes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="avatar", referencedColumnName="id")
     * })
     */
    private $avatar;

    /**
     * @var \Imagenes
     *
     * @ORM\ManyToOne(targetEntity="Imagenes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profile_bg", referencedColumnName="id")
     * })
     */
    private $profileBg;

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
     * Set avatar
     *
     * @param \juzz\DoctrineMetadaBundle\Entity\Imagenes $avatar
     * @return Usuarios
     */
    public function setAvatar(\juzz\DoctrineMetadaBundle\Entity\Imagenes $avatar = null)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return \juzz\DoctrineMetadaBundle\Entity\Imagenes 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set profileBg
     *
     * @param \juzz\DoctrineMetadaBundle\Entity\Imagenes $profileBg
     * @return Usuarios
     */
    public function setProfileBg(\juzz\DoctrineMetadaBundle\Entity\Imagenes $profileBg = null)
    {
        $this->profileBg = $profileBg;

        return $this;
    }

    /**
     * Get profileBg
     *
     * @return \juzz\DoctrineMetadaBundle\Entity\Imagenes 
     */
    public function getProfileBg()
    {
        return $this->profileBg;
    }

    /**
     * Add categoria
     *
     * @param \juzz\DoctrineMetadaBundle\Entity\Categorias $categoria
     * @return Usuarios
     */
    public function addCategorium(\juzz\DoctrineMetadaBundle\Entity\Categorias $categoria)
    {
        $this->categoria[] = $categoria;

        return $this;
    }

    /**
     * Remove categoria
     *
     * @param \juzz\DoctrineMetadaBundle\Entity\Categorias $categoria
     */
    public function removeCategorium(\juzz\DoctrineMetadaBundle\Entity\Categorias $categoria)
    {
        $this->categoria->removeElement($categoria);
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
     * @param \juzz\DoctrineMetadaBundle\Entity\Programas $subscripcion
     * @return Usuarios
     */
    public function addSubscripcion(\juzz\DoctrineMetadaBundle\Entity\Programas $subscripcion)
    {
        $this->subscripcion[] = $subscripcion;

        return $this;
    }

    /**
     * Remove subscripcion
     *
     * @param \juzz\DoctrineMetadaBundle\Entity\Programas $subscripcion
     */
    public function removeSubscripcion(\juzz\DoctrineMetadaBundle\Entity\Programas $subscripcion)
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
     * @param \juzz\DoctrineMetadaBundle\Entity\Usuarios $seguido
     * @return Usuarios
     */
    public function addSeguido(\juzz\DoctrineMetadaBundle\Entity\Usuarios $seguido)
    {
        $this->seguido[] = $seguido;

        return $this;
    }

    /**
     * Remove seguido
     *
     * @param \juzz\DoctrineMetadaBundle\Entity\Usuarios $seguido
     */
    public function removeSeguido(\juzz\DoctrineMetadaBundle\Entity\Usuarios $seguido)
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
     * @param \juzz\DoctrineMetadaBundle\Entity\Programas $programa
     * @return Usuarios
     */
    public function addPrograma(\juzz\DoctrineMetadaBundle\Entity\Programas $programa)
    {
        $this->programa[] = $programa;

        return $this;
    }

    /**
     * Remove programa
     *
     * @param \juzz\DoctrineMetadaBundle\Entity\Programas $programa
     */
    public function removePrograma(\juzz\DoctrineMetadaBundle\Entity\Programas $programa)
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
