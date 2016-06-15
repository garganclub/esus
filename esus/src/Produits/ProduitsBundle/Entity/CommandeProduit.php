<?php

namespace Produits\ProduitsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandeProduit
 *
 * @ORM\Table("commandeproduit")
 * @ORM\Entity(repositoryClass="Produits\ProduitsBundle\Entity\CommandeProduitRepository")
 */
class CommandeProduit
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
     * @ORM\ManyToOne(targetEntity="Produits\ProduitsBundle\Entity\Commande", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;
    
    /**
     * @ORM\ManyToOne(targetEntity="Produits\ProduitsBundle\Entity\Produit", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @var float
     *
     * @ORM\Column(name="tarifArchive", type="float")
     */
    private $tarifArchive;

    /**
     * @var float
     *
     * @ORM\Column(name="tvaArchive", type="float")
     */
    private $tvaArchive;


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
     * Set quantite
     *
     * @param integer $quantite
     * @return CommandeProduit
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    
        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set tarifArchive
     *
     * @param float $tarifArchive
     * @return CommandeProduit
     */
    public function setTarifArchive($tarifArchive)
    {
        $this->tarifArchive = $tarifArchive;
    
        return $this;
    }

    /**
     * Get tarifArchive
     *
     * @return float 
     */
    public function getTarifArchive()
    {
        return $this->tarifArchive;
    }

    /**
     * Set tvaArchive
     *
     * @param float $tvaArchive
     * @return CommandeProduit
     */
    public function setTvaArchive($tvaArchive)
    {
        $this->tvaArchive = $tvaArchive;
    
        return $this;
    }

    /**
     * Get tvaArchive
     *
     * @return float 
     */
    public function getTvaArchive()
    {
        return $this->tvaArchive;
    }

    /**
     * Set commande
     *
     * @param \Produits\ProduitsBundle\Entity\Commande $commande
     * @return CommandeProduit
     */
    public function setCommande(\Produits\ProduitsBundle\Entity\Commande $commande)
    {
        $this->commande = $commande;
    
        return $this;
    }

    /**
     * Get commande
     *
     * @return \Produits\ProduitsBundle\Entity\Commande 
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set produit
     *
     * @param \Produits\ProduitsBundle\Entity\Produit $produit
     * @return CommandeProduit
     */
    public function setProduit(\Produits\ProduitsBundle\Entity\Produit $produit)
    {
        $this->produit = $produit;
    
        return $this;
    }

    /**
     * Get produit
     *
     * @return \Produits\ProduitsBundle\Entity\Produit 
     */
    public function getProduit()
    {
        return $this->produit;
    }
}