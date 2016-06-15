<?php

namespace Produits\ProduitsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Produits\ProduitsBundle\Form\CommandeType;
use Produits\ProduitsBundle\Entity\Commande;

class CommandeController extends Controller
{    
    public function indexAction()
    {
        $utilisateur = $this->container->get('security.context')->getToken()->getUser();
        $session = $this->getRequest()->getSession();
        if($session->has('panier')) {
        	$panier = $session->get('panier');
        }
        else {
        	$panier = false;
        }
        
        if($panier) {
			$em = $this->getDoctrine()->getManager();
			$produits = $em->getRepository('ProduitsBundle:Produit')->parTableau(array_keys($session->get('panier')));
		}
		else {
			$produits = false;
		}
        
        $nomMois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
		$nomJours = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
        $reservations = array();
		$compteur = 0;
        if(isset($_SESSION['datesStockees'])) {
			foreach($_SESSION['datesStockees']['2016'] as $clemois=>$jour) {
				foreach($jour as $clejour=>$nom) {
					foreach($nom as $clenom=>$valeur) {
						if ($valeur == $utilisateur->getUsername()) {
							$reservations[$compteur]['mois'] = $nomMois[intval($clemois) - 1];
							$reservations[$compteur]['jour'] = $clejour;
							$reservations[$compteur]['nom'] = $nomJours[intval($clenom) - 1];
							$compteur++;
						}
					}
				}
			}
		}
		
		$dateCommande = new \DateTime();
        
        return $this->render('ProduitsBundle:Commande:index.html.twig', array(
        	'utilisateur' => $utilisateur,
        	'produits' => $produits,
        	'panier' => $panier,
        	'reservations' => $reservations,
        	'dateCommande' => $dateCommande
        ));
    }

    public function ajouterAction()
    {
        $utilisateur = $this->container->get('security.context')->getToken()->getUser();
        $session = $this->getRequest()->getSession();
        if($session->has('panier')) {
        	$panier = $session->get('panier');
        }
        else {
        	$panier = false;
        }
        
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('ProduitsBundle:Produit')->parTableau(array_keys($session->get('panier')));
        
        $numeroFacture = $this->container->get('gestionFacture')->numerote();
        
        return $this->render('ProduitsBundle:Commande:facture.html.twig', array(
        	'utilisateur' => $utilisateur,
        	'produits' => $produits,
        	'panier' => $panier,
        	'numeroFacture' => $numeroFacture
        ));
    }
}