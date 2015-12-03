<?php

namespace juzz\DoctrineMetadaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etiquetas
 *
 * @ORM\Table(name="etiquetas")
 * @ORM\Entity
 */
class Etiquetas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer", nullable=false)
     */
    private $count;

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
     * Set count
     *
     * @param integer $count
     * @return Etiquetas
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set termino
     *
     * @param \juzz\DoctrineMetadaBundle\Entity\Terminos $termino
     * @return Etiquetas
     */
    public function setTermino(\juzz\DoctrineMetadaBundle\Entity\Terminos $termino)
    {
        $this->termino = $termino;

        return $this;
    }

    /**
     * Get termino
     *
     * @return \juzz\DoctrineMetadaBundle\Entity\Terminos 
     */
    public function getTermino()
    {
        return $this->termino;
    }
}