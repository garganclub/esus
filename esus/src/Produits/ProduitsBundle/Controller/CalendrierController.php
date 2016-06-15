<?php

namespace Produits\ProduitsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Produits\ProduitsBundle\Entity\Atelier;
use Produits\ProduitsBundle\Form\AtelierType;

use Produits\ProduitsBundle\Entity\Poste;
use Produits\ProduitsBundle\Form\PosteType;

use Symfony\Component\HttpFoundation\Session\Session;

class CalendrierController extends Controller
{
    public function indexAction()
    {       
        $utilisateur = $this->container->get('security.context')->getToken()->getUser()->getUsername();
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('ProduitsBundle:Poste')->findAll();
        $dates = $entities[0]->getCalendrier();
        $session = $this->getRequest()->getSession();
        if(!$session->has('calendrier')) {
        	$session->set('calendrier', array('dates' => ''));
        	$calendrier['dates'] = $dates;
        	$session->set('calendrier', $calendrier);
        	$_SESSION['datesStockees'] = $calendrier['dates'];
        }
        else {
        	if(isset($_POST["moisAncien"])) {
        		$calendrier['moisAncien'] = $_POST["moisAncien"];
        		$session->set('calendrier', $calendrier);
        	}
        	if(isset($_POST["moisEnCours"])) {
        		$calendrier['moisEnCours'] = $_POST["moisEnCours"];
        		$session->set('calendrier', $calendrier);
        	}
        	if(isset($_POST["moisCourant"])) {
        		$calendrier['moisCourant'] = $_POST["moisCourant"];
        		$session->set('calendrier', $calendrier);
        	}
        	if(isset($_POST["jours"])) {
        		$calendrier['jours'] = $_POST["jours"];
        		$session->set('calendrier', $calendrier);
        	}
        	if(isset($_POST["noms"])) {
        		$calendrier['noms'] = $_POST["noms"];
        		$session->set('calendrier', $calendrier);
        	}
        	if(isset($_POST["joursEffaces"])) {
        		$calendrier['joursEffaces'] = $_POST["joursEffaces"];
        		$session->set('calendrier', $calendrier);
        	}
        	if(isset($_POST["nomsEffaces"])) {
        		$calendrier['nomsEffaces'] = $_POST["nomsEffaces"];
        		$session->set('calendrier', $calendrier);
        	}
        	
        	$nomMois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
			$nomJours = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
			function enregistreSelections(&$dates, $moisEnCours, $utilisateur) {
				$conversionNoms = array('Lundi' => '1', 'Mardi' => '2', 'Mercredi' => '3', 'Jeudi' => '4', 'Vendredi' => '5', 'Samedi' => '6', 'Dimanche' => '7');
				$moisCorrect = ($moisEnCours < 10 ? '0'.$moisEnCours : ''.$moisEnCours);
				if(isset($_POST['jours'])) {
					if($_POST['jours'] != '') {
						$listeJours = explode(", ", $_POST['jours']);
						$listeNoms = explode(", ", $_POST['noms']);
						for($i=0;$i<(sizeOf($listeJours)-1);$i++) {
							if($utilisateur != '' && $utilisateur != 'anon.' && $utilisateur != 'Non référencé') {
								if(isset($dates['2016'][$moisCorrect][$listeJours[$i]][$conversionNoms[$listeNoms[$i]]])) {
									$dates['2016'][$moisCorrect][$listeJours[$i]][$conversionNoms[$listeNoms[$i]]] = $utilisateur;
								}
							}
						}
					}
				}
				if(isset($_POST['joursEffaces'])) {
					if($_POST['joursEffaces'] != '') {
						$listeJoursEffaces = explode(", ", $_POST['joursEffaces']);
						$listeNomsEffaces = explode(", ", $_POST['nomsEffaces']);
						for($i=0;$i<(sizeOf($listeJoursEffaces)-1);$i++) {
							if(isset($dates['2016'][$moisCorrect][$listeJoursEffaces[$i]][$conversionNoms[$listeNomsEffaces[$i]]])) {
								$dates['2016'][$moisCorrect][$listeJoursEffaces[$i]][$conversionNoms[$listeNomsEffaces[$i]]] = '0';
							}
						}
					}
				}
				return $dates;
			}
			
			if(isset($_POST['validation']) && $_POST['validation'] != '') {
				if(isset($_POST['jours']) && isset($_POST['noms']) || isset($_POST['joursEffaces']) && isset($_POST['nomsEffaces'])) {
					if($_POST['jours'] != '' && $_POST['noms'] != '' || $_POST['joursEffaces'] != '' && $_POST['nomsEffaces'] != '') {
						if(isset($_POST["moisEnCours"]) && $_POST['moisEnCours'] != '') {
							$_SESSION['datesStockees'] = enregistreSelections($_SESSION['datesStockees'], $_POST["moisEnCours"], $utilisateur);
						}
						$calendrier['dates'] = $_SESSION['datesStockees'];
						$session->set('calendrier', $calendrier);
					}
				}
				$reservations = array();
				$compteur = 0;
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
				return $this->render('ProduitsBundle:Calendrier:selection.html.twig', array(
					'utilisateur' => $utilisateur,
					'entities' => $entities,
					'session' => $session->get('calendrier'),
					'dates' => $_SESSION['datesStockees'],
					'reservations' => $reservations
				));
			}
			else {
				if(isset($_POST['jours']) && isset($_POST['noms']) || isset($_POST['joursEffaces']) && isset($_POST['nomsEffaces'])) {
					if($_POST['jours'] != '' && $_POST['noms'] != '' || $_POST['joursEffaces'] != '' && $_POST['nomsEffaces'] != '') {
						if(isset($_POST["moisAncien"]) && $_POST['moisAncien'] != '') {
							$_SESSION['datesStockees'] = enregistreSelections($_SESSION['datesStockees'], $_POST["moisAncien"], $utilisateur);
						}
						$calendrier['dates'] = $_SESSION['datesStockees'];
						$session->set('calendrier', $calendrier);
					}
				}
			}
        }
        
        return $this->render('ProduitsBundle:Calendrier:index.html.php', array(
        	'utilisateur' => $utilisateur,
        	'entities' => $entities,
        	'session' => $session->get('calendrier'),
        	'dates' => $_SESSION['datesStockees']
        ));
    }
}