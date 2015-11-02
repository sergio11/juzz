<?php

namespace juzz\juzzBundle\Entity;

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
     * @ORM\ManyToOne(targetEntity="Categorias")
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
     * @ORM\OneToOne(targetEntity="Terminos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="termino_id", referencedColumnName="id")
     * })
     */
    private $termino;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Usuarios", mappedBy="categoria")
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
     * @param \juzz\juzzBundle\Entity\Categorias $parent
     *
     * @return Categorias
     */
    public function setParent(\juzz\juzzBundle\Entity\Categorias $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \juzz\juzzBundle\Entity\Categorias
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set termino
     *
     * @param \juzz\juzzBundle\Entity\Terminos $termino
     *
     * @return Categorias
     */
    public function setTermino(\juzz\juzzBundle\Entity\Terminos $termino)
    {
        $this->termino = $termino;

        return $this;
    }

    /**
     * Get termino
     *
     * @return \juzz\juzzBundle\Entity\Terminos
     */
    public function getTermino()
    {
        return $this->termino;
    }

    /**
     * Add usuario
     *
     * @param \juzz\juzzBundle\Entity\Usuarios $usuario
     *
     * @return Categorias
     */
    public function addUsuario(\juzz\juzzBundle\Entity\Usuarios $usuario)
    {
        $this->usuario[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \juzz\juzzBundle\Entity\Usuarios $usuario
     */
    public function removeUsuario(\juzz\juzzBundle\Entity\Usuarios $usuario)
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
