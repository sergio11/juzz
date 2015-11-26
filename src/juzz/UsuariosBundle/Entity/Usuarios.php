<?php

namespace juzz\UsuariosBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios", uniqueConstraints={@ORM\UniqueConstraint(name="USU_EMA_UK", columns={"email"})}, indexes={@ORM\Index(name="USU_AVA_FK", columns={"avatar"}), @ORM\Index(name="USU_PRO_FK", columns={"profile_bg"})})
 * @ORM\Entity
 */
class Usuarios implements UserInterface, \Serializable
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
    *
    *  @var string
    *   
    *  @ORM\Column(name="nick", type="string", length=90, nullable=false)
    *
    */

    private $nick;

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
     * @ORM\ManyToOne(targetEntity="\juzz\FilesBundle\Entity\Imagenes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="avatar", referencedColumnName="id")
     * })
     */
    private $avatar;

    /**
     * @var \Imagenes
     *
     * @ORM\ManyToOne(targetEntity="\juzz\FilesBundle\Entity\Imagenes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profile_bg", referencedColumnName="id")
     * })
     */
    private $profileBg;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="\juzz\EpisodiosBundle\Entity\Categorias", inversedBy="usuario")
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
     * @ORM\ManyToMany(targetEntity="\juzz\ProgramasBundle\Entity\Programas", inversedBy="subscriptor")
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
     * @ORM\ManyToMany(targetEntity="\juzz\ProgramasBundle\Entity\Programas", inversedBy="usuario")
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
    *
    * Get Nick
    * @return string
    *
    */

    public function getNick()
    {
        return $this->nick;
    }

    /**
     * Set nick
     *
     * @param string $nick
     * @return Usuarios
     */
    public function setNick($nick)
    {
        $this->nick = $nick;
        return $this;
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


    public function getApellidos(){
        return $this->ape1 . " " . $this->ape2;
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

    public function getNombreCompleto()
    {
        return $this->nombre . " " . $this->ape1 . " " . $this->ape2; 
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
     * @param \juzz\FilesBundle\Entity\Imagenes $avatar
     * @return Usuarios
     */
    public function setAvatar(\juzz\FilesBundle\Entity\Imagenes $avatar = null)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return \juzz\FilesBundle\Entity\Imagenes 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set profileBg
     *
     * @param \juzz\FilesBundle\Entity\Imagenes $profileBg
     * @return Usuarios
     */
    public function setProfileBg(\juzz\FilesBundle\Entity\Imagenes $profileBg = null)
    {
        $this->profileBg = $profileBg;

        return $this;
    }

    /**
     * Get profileBg
     *
     * @return \juzz\FilesBundle\Entity\Imagenes 
     */
    public function getProfileBg()
    {
        return $this->profileBg;
    }

    /**
     * Add categoria
     *
     * @param \juzz\EpisodiosBundle\Entity\Categorias $categoria
     * @return Usuarios
     */
    public function addCategorium(\juzz\EpisodiosBundle\Entity\Categorias $categoria)
    {
        $this->categoria[] = $categoria;

        return $this;
    }

    /**
     * Remove categoria
     *
     * @param \juzz\EpisodiosBundle\Entity\Categorias $categoria
     */
    public function removeCategorium(\juzz\EpisodiosBundle\Entity\Categorias $categoria)
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
     * @param \juzz\ProgramasBundle\Entity\Programas $subscripcion
     * @return Usuarios
     */
    public function addSubscripcion(\juzz\ProgramasBundle\Entity\Programas $subscripcion)
    {
        $this->subscripcion[] = $subscripcion;

        return $this;
    }

    /**
     * Remove subscripcion
     *
     * @param \juzz\ProgramasBundle\Entity\Programas $subscripcion
     */
    public function removeSubscripcion(\juzz\ProgramasBundle\Entity\Programas $subscripcion)
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
     * @param \juzz\UsuariosBundle\Entity\Usuarios $seguido
     * @return Usuarios
     */
    public function addSeguido(\juzz\UsuariosBundle\Entity\Usuarios $seguido)
    {
        $this->seguido[] = $seguido;

        return $this;
    }

    /**
     * Remove seguido
     *
     * @param \juzz\UsuariosBundle\Entity\Usuarios $seguido
     */
    public function removeSeguido(\juzz\UsuariosBundle\Entity\Usuarios $seguido)
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
     * @param \juzz\ProgramasBundle\Entity\Programas $programa
     * @return Usuarios
     */
    public function addPrograma(\juzz\ProgramasBundle\Entity\Programas $programa)
    {
        $this->programa[] = $programa;

        return $this;
    }

    /**
     * Remove programa
     *
     * @param \juzz\ProgramasBundle\Entity\Programas $programa
     */
    public function removePrograma(\juzz\ProgramasBundle\Entity\Programas $programa)
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

    public function getUsername()
    {
        return $this->email;
    }
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }
    public function getRoles()
    {
        return array('ROLE_USER');
    }
    public function eraseCredentials()
    {
    }
     /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->nombre,
            $this->password,
            $this->nick
            // see section on salt below
            // $this->salt,
        ));
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->nombre,
            $this->password,
            $this->nick
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
}
