<?php
namespace Produits\ProduitsBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class GestionFacture {
    public function __construct(ContainerInterface $container, $entityManager) {
    	$this->securityContext = $container->get('security.context');
    	$this->em = $entityManager;
    }
    public function numerote() {
    	if(is_object($this->securityContext->getToken()->getUser())) {
    		$utilisateur = $this->securityContext->getToken()->getUser();
			$numero = $this->em->getRepository('ProduitsBundle:Commande')->controleFacture($utilisateur);
			if(!is_object($numero)) {
				return 0;
			}
			else {
				return $numero->getFacture() + 1;
			}
		}
		else {
			return 0;
		}
    }
}