<?php

namespace juzz\UsuariosBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Accessor;



/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios", uniqueConstraints={@ORM\UniqueConstraint(name="USU_EMA_UK", columns={"email"})}, indexes={@ORM\Index(name="USU_AVA_FK", columns={"avatar"}), @ORM\Index(name="USU_PRO_FK", columns={"profile_bg"})})
 * @ORM\Entity
 * @UniqueEntity(
 *     fields="email",
 *     message="Ya existe un usuario con este email"
 * )
 * @UniqueEntity(
 *     fields="nick",
 *     message="Ya existe un usuario con este nick"
 * )
 * @Vich\Uploadable
 * @ExclusionPolicy("all")
 */
class Usuarios implements UserInterface, \Serializable
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=false)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(
     *      min = 3,
     *      max = 30,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     * @Expose
     * @Accessor(getter="getFullName")
     * @SerializedName("fullName")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="genero", type="string", length=1, nullable=false)
     * @Assert\Choice(choices = {"m", "f"}, message = "Choose a valid gender.")
     */
    private $genero;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     * @Assert\Length(
     *      min = 0,
     *      max = 500,
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @Expose
     */
    private $descripcion;


    /**
    *
    *  @var string
    *   
    *  @ORM\Column(name="nick", type="string", length=90, nullable=false)
    *  @Assert\NotBlank()
    *  @Assert\NotNull()
    *  @Expose
    *
    */

    private $nick;

    /**
     * @var string
     *
     * @ORM\Column(name="ape1", type="string", length=30, nullable=false)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(
     *      min = 3,
     *      max = 30,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your first ape cannot contain a number"
     * )
     */
    private $ape1;

    /**
     * @var string
     *
     * @ORM\Column(name="ape2", type="string", length=30, nullable=false)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your Secod ape cannot contain a number"
     * )
     */
    private $ape2;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=90, nullable=false)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = false
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60, nullable=false)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * 
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
     * @var File
     * @Assert\File(
     *     maxSize="1M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="user_avatar", fileNameProperty="avatar")
     * 
     */
    private $avatarFile;

    /**
     * @var string
     * @ORM\Column(name="avatar",type="string", length=255)
     * @Expose
     */
    private $avatar;

    /**
     * @ORM\Column(name="updated_avatar_at",type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAvatarAt;


    /**
     * @var \Paises
     *
     * @ORM\ManyToOne(targetEntity="\juzz\UsuariosBundle\Entity\Paises",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="origen", referencedColumnName="id")
     * })
     */
    private $origen;

    /**
     * @var \PoliticaComentarios
     *
     * @ORM\ManyToOne(targetEntity="\juzz\CommentsBundle\Entity\PoliticaComentarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="politica_comentarios", referencedColumnName="id")
     * })
     */
    private $politicaComentarios;


    /**
     * @var File
     * @Assert\File(
     *     maxSize="1M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="user_profile_bg", fileNameProperty="profileBg")
     * 
     */
    private $profileBgFile;

    /**
     * @var string
     * @ORM\Column(name="profile_bg",type="string", length=255)
     * 
     */
    private $profileBg;

    /**
     * @ORM\Column(name="updated_profilebg_at",type="datetime")
     *
     * @var \DateTime
     */
    private $updatedProfileBgAt;

    

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
     * @ORM\OneToMany(targetEntity="\juzz\UsuariosBundle\Entity\Followers", mappedBy="following", cascade={"persist", "remove","all"})
     */
    protected $followers;
    
    /**
     * @ORM\OneToMany(targetEntity="\juzz\UsuariosBundle\Entity\Followers", mappedBy="follower", cascade={"persist", "remove","all"})
     */
    protected $following;

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
     * Random string sent to the user email address in order to verify it
     * @ORM\Column(name="confirmation_token", type="string", length=32, nullable=true)
     * @var string
     */
    protected $confirmationToken;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categoria = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subscripcion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->programa = new \Doctrine\Common\Collections\ArrayCollection();
        $this->followers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->following = new \Doctrine\Common\Collections\ArrayCollection();
       
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
     * Set genero
     *
     * @param string $genero
     * @return Usuarios
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero
     *
     * @return string 
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Usuarios
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

    public function getFullName()
    {
        return $this->nombre . " " . $this->ape1 . " " . $this->ape2; 
    }

    /**
     * Set origen
     *
     * @param \juzz\UsuariosBundle\Entity\Paises $origen
     * @return Usuarios
     */
    public function setOrigen(\juzz\UsuariosBundle\Entity\Paises $origen = null)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return \juzz\UsuariosBundle\Entity\Paises 
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set politicaComentarios
     *
     * @param \juzz\CommentsBundle\Entity\PoliticaComentarios $politicaComentarios
     * @return Usuarios
     */
    public function setPoliticaComentarios(\juzz\CommentsBundle\Entity\PoliticaComentarios $politicaComentarios = null)
    {
        $this->politicaComentarios = $politicaComentarios;

        return $this;
    }

    /**
     * Get politicaComentarios
     *
     * @return \juzz\CommentsBundle\Entity\PoliticaComentarios 
     */
    public function getPoliticaComentarios()
    {
        return $this->politicaComentarios;
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
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Usuario
     */
    public function setAvatarFile(File $image = null)
    {
        $this->avatarFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAvatarAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getAvatarFile()
    {
        return $this->avatarFile;
    }

    /**
     * Set Avatar File Name
     * @param string $avatar
     * @return Usuarios
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * Get avatar
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Usuario
     */
    public function setProfileBgFile(File $image = null)
    {
        $this->profileBgFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedProfileBgAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getProfileBgFile()
    {
        return $this->profileBgFile;
    }

    /**
     * Set profileBg name
     *
     * @param string $profileBg
     * @return Usuarios
     */
    public function setProfileBg($profileBg = null)
    {
        $this->profileBg = $profileBg;

        return $this;
    }

    /**
     * Get profileBg name
     *
     * @return string
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

     public function getFollowers()
    {
        return $this->followers->map(function($item){
            return $item->getFollower();
        });
    }
    

    public function addFollower(Followers $follower)
    {
        if (!$this->followers->contains($follower)) {
            $this->followers->add($follower);
        }

        return $this;
    }

    public function removeFollower(Usuarios $follower)
    {
        $idx = $this->followers->map(function($item){
            return $item->getFollower();
        })->indexOf($follower);
        
        $this->followers->remove($idx);
        
        return $this;
    }
    
    public function getFollowing(){
        return $this->following;
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
    
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }
    
    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;
        return $this;
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
