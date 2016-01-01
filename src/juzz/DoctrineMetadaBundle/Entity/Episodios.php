<?php

namespace juzz\DoctrineMetadaBundle\Entity;

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
     * @ORM\Column(name="descripcion", type="text", nullable=true)
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
     * @ORM\ManyToOne(targetEntity="Programas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="programa_id", referencedColumnName="id")
     * })
     */
    private $programa;


}
