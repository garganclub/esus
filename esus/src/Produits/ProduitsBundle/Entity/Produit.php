<?php

namespace Produits\ProduitsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table("produit")
 * @ORM\Entity(repositoryClass="Produits\ProduitsBundle\Entity\ProduitRepository")
 */
class Produit
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
     * @ORM\ManyToOne(targetEntity="Produits\ProduitsBundle\Entity\Tva", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $tva;
    
     /**
     * @ORM\ManyToOne(targetEntity="Produits\ProduitsBundle\Entity\Categorie", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=125)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="article", type="text")
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var float
     *
     * @ORM\Column(name="tarif", type="float")
     */
    private $tarif;

    /**
     * @var boolean
     *
     * @ORM\Column(name="confirme", type="boolean")
     */
    private $confirme;

    function __construct() {
        $this->confirme = false;
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
     * Set titre
     *
     * @param string $titre
     * @return Produit
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set article
     *
     * @param string $article
     * @return Produit
     */
    public function setArticle($article)
    {
        $this->article = $article;
    
        return $this;
    }

    /**
     * Get article
     *
     * @return string 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Produit
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set tarif
     *
     * @param float $tarif
     * @return Produit
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;
    
        return $this;
    }

    /**
     * Get tarif
     *
     * @return float 
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set confirme
     *
     * @param boolean $confirme
     * @return Produit
     */
    public function setConfirme($confirme)
    {
        $this->confirme = $confirme;
    
        return $this;
    }

    /**
     * Get confirme
     *
     * @return boolean 
     */
    public function getConfirme()
    {
        return $this->confirme;
    }

    /**
     * Set tva
     *
     * @param \Produits\ProduitsBundle\Entity\Tva $tva
     * @return Produit
     */
    public function setTva(\Produits\ProduitsBundle\Entity\Tva $tva)
    {
        $this->tva = $tva;
    
        return $this;
    }

    /**
     * Get tva
     *
     * @return \Produits\ProduitsBundle\Entity\Tva 
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set categorie
     *
     * @param \Produits\ProduitsBundle\Entity\Categorie $categorie
     * @return Produit
     */
    public function setCategorie(\Produits\ProduitsBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;
    
        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Produits\ProduitsBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}