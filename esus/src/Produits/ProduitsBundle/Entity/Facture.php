<?php

namespace Produits\ProduitsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table("facture")
 * @ORM\Entity(repositoryClass="Produits\ProduitsBundle\Entity\FactureRepository")
 */
class Facture
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateFacture", type="datetimetz")
     */
    private $dateFacture;

    /**
     * @var integer
     *
     * @ORM\Column(name="numeroFacture", type="integer")
     */
    private $numeroFacture;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reglee", type="boolean")
     */
    private $reglee;
    
    function __construct() {
        $this->dateFacture(new \DateTime());
        $this->reglee = false;
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
     * Set dateFacture
     *
     * @param \DateTime $dateFacture
     * @return Facture
     */
    public function setDateFacture($dateFacture)
    {
        $this->dateFacture = $dateFacture;
    
        return $this;
    }

    /**
     * Get dateFacture
     *
     * @return \DateTime 
     */
    public function getDateFacture()
    {
        return $this->dateFacture;
    }

    /**
     * Set reglee
     *
     * @param boolean $reglee
     * @return Facture
     */
    public function setReglee($reglee)
    {
        $this->reglee = $reglee;
    
        return $this;
    }

    /**
     * Get reglee
     *
     * @return boolean 
     */
    public function getReglee()
    {
        return $this->reglee;
    }

    /**
     * Set numeroFacture
     *
     * @param integer $numeroFacture
     * @return Facture
     */
    public function setNumeroFacture($numeroFacture)
    {
        $this->numeroFacture = $numeroFacture;
    
        return $this;
    }

    /**
     * Get numeroFacture
     *
     * @return integer 
     */
    public function getNumeroFacture()
    {
        return $this->numeroFacture;
    }
}