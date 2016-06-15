<?php

namespace Produits\ProduitsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PanierController extends Controller
{
    public function menuAction() {
    	$session = $this->getRequest()->getSession();
    	if(!$session->has('panier')) {
        	$articles = 0;
        }
        else {
        	$articles = count($session->get('panier'));
        }
        return $this->render('ProduitsBundle:Modules:panierArticles.html.twig', array(
        	'articles' => $articles
        ));
    }
    
    public function panierAction()
    {
        $utilisateur = $this->container->get('security.context')->getToken()->getUser()->getUsername();
        $session = $this->getRequest()->getSession();
        if(!$session->has('panier')) {
        	$session->set('panier', array());
        }
        //var_dump($session->get('panier'));
        //die();
        //pour effacer le panier dans la session
        //au cours des tests
        //$session->remove('panier');
        //die();
        //sinon effacer le cache
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('ProduitsBundle:Produit')->parTableau(array_keys($session->get('panier')));
        
        $nomMois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
		$nomJours = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
        $reservations = array();
		$compteur = 0;
        if(isset($_SESSION['datesStockees'])) {
			foreach($_SESSION['datesStockees']['2016'] as $clemois=>$jour) {
				foreach($jour as $clejour=>$nom) {
					foreach($nom as $clenom=>$valeur) {
						if ($valeur == $utilisateur) {
							$reservations[$compteur]['mois'] = $nomMois[intval($clemois) - 1];
							$reservations[$compteur]['jour'] = $clejour;
							$reservations[$compteur]['nom'] = $nomJours[intval($clenom) - 1];
							$compteur++;
						}
					}
				}
			}
		}
        
        return $this->render('ProduitsBundle:Panier:panier.html.twig', array(
        	'produits' => $produits,
        	'panier' => $session->get('panier'),
        	'reservations' => $reservations
        ));
    }
    public function ajouterAction($id)
    {
        if(is_object($this->container->get('security.context')->getToken()->getUser())) {
			$session = $this->getRequest()->getSession();
			if(!$session->has('panier')) {
				$session->set('panier', array());
			}
			$panier = $session->get('panier');
			if(array_key_exists($id, $panier)) {
				if($this->getRequest()->query->get('qte') != null) {
					$panier[$id] = (int)$this->getRequest()->query->get('qte');
				}
				$this->get('session')->getFlashBag()->add('success', 'Quantité modifiée');
			}
			else {
				if($this->getRequest()->query->get('qte') != null) {
					$panier[$id] = (int)$this->getRequest()->query->get('qte');
				}
				else {
					$panier[$id] = 1;
				}
				$this->get('session')->getFlashBag()->add('success', 'Article ajouté');
			}
			$session->set('panier', $panier);
        }
                
        return $this->redirect($this->generateUrl('produits_panier'));
    }
    public function supprimerAction($id)
    {
        $session = $this->getRequest()->getSession();
        $panier = $session->get('panier');
        if(array_key_exists($id, $panier)) {
        	unset($panier[$id]);
        	$session->set('panier', $panier);
        	$this->get('session')->getFlashBag()->add('success', 'Article supprimé');
        }
        return $this->redirect($this->generateUrl('produits_panier'));
    }
    public function factureAction()
    {
        return $this->render('ProduitsBundle:Panier:facture.html.twig');
    }
}