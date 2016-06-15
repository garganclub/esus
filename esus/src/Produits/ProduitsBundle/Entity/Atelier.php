<?php

namespace Produits\ProduitsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Atelier
 *
 * @ORM\Table("atelier")
 * @ORM\Entity(repositoryClass="Produits\ProduitsBundle\Entity\AtelierRepository")
 */
class Atelier
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
     * @var string
     *
     * @ORM\Column(name="nomAtelier", type="string", length=255)
     */
    private $nomAtelier;


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
     * Set nomAtelier
     *
     * @param string $nomAtelier
     * @return Atelier
     */
    public function setNomAtelier($nomAtelier)
    {
        $this->nomAtelier = $nomAtelier;
    
        return $this;
    }

    /**
     * Get nomAtelier
     *
     * @return string 
     */
    public function getNomAtelier()
    {
        return $this->nomAtelier;
    }
}