<?php

namespace Produits\ProduitsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table("commande")
 * @ORM\Entity(repositoryClass="Produits\ProduitsBundle\Entity\CommandeRepository")
 */
class Commande
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
     * @ORM\ManyToOne(targetEntity="Utilisateurs\UtilisateursBundle\Entity\Utilisateurs", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;
    
    /**
     * @ORM\ManyToOne(targetEntity="Produits\ProduitsBundle\Entity\Facture", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $facture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCommande", type="datetimetz")
     */
    private $dateCommande;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="honoree", type="boolean")
     */
    private $honoree;
    
    function __construct() {
        $this->dateCommande(new \DateTime());
        $this->honoree = false;
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
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     * @return Commande
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;
    
        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime 
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set honoree
     *
     * @param boolean $honoree
     * @return Commande
     */
    public function setHonoree($honoree)
    {
        $this->honoree = $honoree;
    
        return $this;
    }

    /**
     * Get honoree
     *
     * @return boolean 
     */
    public function getHonoree()
    {
        return $this->honoree;
    }

    /**
     * Set utilisateur
     *
     * @param \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $utilisateur
     * @return Commande
     */
    public function setUtilisateur(\Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $utilisateur)
    {
        $this->utilisateur = $utilisateur;
    
        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set facture
     *
     * @param \Produits\ProduitsBundle\Entity\Facture $facture
     * @return Commande
     */
    public function setFacture(\Produits\ProduitsBundle\Entity\Facture $facture)
    {
        $this->facture = $facture;
    
        return $this;
    }

    /**
     * Get facture
     *
     * @return \Produits\ProduitsBundle\Entity\Facture 
     */
    public function getFacture()
    {
        return $this->facture;
    }
}