<?php

namespace juzz\EpisodiosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorias
 *
 * @ORM\Table(name="categorias", indexes={@ORM\Index(name="CAT_FK", columns={"parent_id"})})
 * @ORM\Entity
 */
class Categorias
{
    /**
     * @var \Categorias
     *
     * @ORM\ManyToOne(targetEntity="\juzz\EpisodiosBundle\Entity\Categorias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="termino_id")
     * })
     */
    private $parent;

    /**
     * @var \Terminos
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="\juzz\EpisodiosBundle\Entity\Terminos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="termino_id", referencedColumnName="id")
     * })
     */
    private $termino;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="\juzz\UsuariosBundle\Entity\Usuarios", mappedBy="categoria")
     */
    private $usuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set parent
     *
     * @param \juzz\EpisodiosBundle\Entity\Categorias $parent
     * @return Categorias
     */
    public function setParent(\juzz\EpisodiosBundle\Entity\Categorias $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \juzz\EpisodiosBundle\Entity\Categorias 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set termino
     *
     * @param \juzz\EpisodiosBundle\Entity\Terminos $termino
     * @return Categorias
     */
    public function setTermino(\juzz\EpisodiosBundle\Entity\Terminos $termino)
    {
        $this->termino = $termino;

        return $this;
    }

    /**
     * Get termino
     *
     * @return \juzz\EpisodiosBundle\Entity\Terminos 
     */
    public function getTermino()
    {
        return $this->termino;
    }

    /**
     * Add usuario
     *
     * @param \juzz\UsuariosBundle\Entity\Usuarios $usuario
     * @return Categorias
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
