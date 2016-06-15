<?php

namespace Produits\ProduitsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poste
 *
 * @ORM\Table("poste")
 * @ORM\Entity(repositoryClass="Produits\ProduitsBundle\Entity\PosteRepository")
 */
class Poste
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Produits\ProduitsBundle\Entity\Atelier", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $atelier;

    /**
     * @var integer
     *
     * @ORM\Column(name="numeroPoste", type="integer")
     */
    private $numeroPoste;

    /**
     * @var array
     *
     * @ORM\Column(name="calendrier", type="array", nullable=true)
     */
    private $calendrier;


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
     * Set numeroPoste
     *
     * @param integer $numeroPoste
     * @return Poste
     */
    public function setNumeroPoste($numeroPoste)
    {
        $this->numeroPoste = $numeroPoste;
    
        return $this;
    }

    /**
     * Get numeroPoste
     *
     * @return integer 
     */
    public function getNumeroPoste()
    {
        return $this->numeroPoste;
    }

    /**
     * Set calendrier
     *
     * @param array $calendrier
     * @return Poste
     */
    public function setCalendrier($calendrier)
    {
        $this->calendrier = $calendrier;
    
        return $this;
    }

    /**
     * Get calendrier
     *
     * @return array 
     */
    public function getCalendrier()
    {
        return $this->calendrier;
    }

    /**
     * Set atelier
     *
     * @param \Produits\ProduitsBundle\Entity\Atelier $atelier
     * @return Poste
     */
    public function setAtelier(\Produits\ProduitsBundle\Entity\Atelier $atelier)
    {
        $this->atelier = $atelier;
    
        return $this;
    }

    /**
     * Get atelier
     *
     * @return \Produits\ProduitsBundle\Entity\Atelier 
     */
    public function getAtelier()
    {
        return $this->atelier;
    }
}