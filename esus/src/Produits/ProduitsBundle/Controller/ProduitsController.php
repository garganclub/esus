<?php

namespace Produits\ProduitsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Produits\ProduitsBundle\Form\ProduitType;
use Produits\ProduitsBundle\Entity\Produit;

class ProduitsController extends Controller
{
    public function indexAction()
    {       
        $session = $this->getRequest()->getSession();
        if($session->has('panier')) {
        	$panier = $session->get('panier');
        }
        else {
        	$panier = false;
        }
        
        $em = $this->getDoctrine()->getManager();
        $recupereProduits = $em->getRepository('ProduitsBundle:Produit')->findAll();
        
        $produits = $this->get('knp_paginator')->paginate($recupereProduits,$this->get('request')->query->get('page', 1),3);
        
        return $this->render('ProduitsBundle:Default:index.html.twig', array(
        	'produits' => $produits,
        	'panier' => $panier
        ));
    }
     public function produitAction($id)
    {
        $session = $this->getRequest()->getSession();
        if($session->has('panier')) {
        	$panier = $session->get('panier');
        }
        else {
        	$panier = false;
        }
        
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('ProduitsBundle:Produit')->find($id);
        
        return $this->render('ProduitsBundle:Default:produit.html.twig', array(
        	'produit' => $produit,
        	'panier' => $panier
        ));
    }
}