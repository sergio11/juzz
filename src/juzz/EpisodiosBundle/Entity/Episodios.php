<?php

namespace juzz\EpisodiosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Episodios
 *
 * @ORM\Table(name="episodios", uniqueConstraints={@ORM\UniqueConstraint(name="EPI_FIL_UK", columns={"file"})}, indexes={@ORM\Index(name="EPI_CAT_FK", columns={"categoria_id"}), @ORM\Index(name="EPI_GEN_FK", columns={"genero_id"}), @ORM\Index(name="EPI_PRO_FK", columns={"programa_id"})})
 * @ORM\Entity
 */
class Episodios
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
     * @ORM\Column(name="titulo", type="string", length=30, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=60, nullable=false)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=16777215, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="poster", type="string", length=60, nullable=false)
     */
    private $poster;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duracion", type="time", nullable=false)
     */
    private $duracion;

    /**
     * @var \Categorias
     *
     * @ORM\ManyToOne(targetEntity="Categorias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="termino_id")
     * })
     */
    private $categoria;

    /**
     * @var \Generos
     *
     * @ORM\ManyToOne(targetEntity="Generos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="genero_id", referencedColumnName="id")
     * })
     */
    private $genero;

    /**
     * @var \Programas
     *
     * @ORM\ManyToOne(targetEntity="\juzz\ProgramasBundle\Entity\Programas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="programa_id", referencedColumnName="id")
     * })
     */
    private $programa;



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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Episodios
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return Episodios
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Episodios
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
     * Set poster
     *
     * @param string $poster
     *
     * @return Episodios
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return string
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set duracion
     *
     * @param \DateTime $duracion
     *
     * @return Episodios
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get duracion
     *
     * @return \DateTime
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set categoria
     *
     * @param \juzz\juzzBundle\Entity\Categorias $categoria
     *
     * @return Episodios
     */
    public function setCategoria(\juzz\juzzBundle\Entity\Categorias $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \juzz\juzzBundle\Entity\Categorias
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set genero
     *
     * @param \juzz\juzzBundle\Entity\Generos $genero
     *
     * @return Episodios
     */
    public function setGenero(\juzz\juzzBundle\Entity\Generos $genero = null)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero
     *
     * @return \juzz\juzzBundle\Entity\Generos
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set programa
     *
     * @param \juzz\juzzBundle\Entity\Programas $programa
     *
     * @return Episodios
     */
    public function setPrograma(\juzz\juzzBundle\Entity\Programas $programa = null)
    {
        $this->programa = $programa;

        return $this;
    }

    /**
     * Get programa
     *
     * @return \juzz\juzzBundle\Entity\Programas
     */
    public function getPrograma()
    {
        return $this->programa;
    }
}
