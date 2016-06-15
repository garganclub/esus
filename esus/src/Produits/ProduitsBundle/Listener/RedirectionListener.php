<?php
namespace Produits\ProduitsBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RedirectionListener {
    public function __construct(ContainerInterface $container, Session $session) {
    	$this->session = $session;
    	$this->router = $container->get('router');
    	$this->url = $container->get('router')->getContext()->getBaseUrl();
    	$this->securityContext = $container->get('security.context');
    }
    public function onKernelRequest(GetResponseEvent $event) {
    	$route = $event->getRequest()->attributes->get('_route');
    	$url = $event->getRequest()->headers->get('referer');
    	if($route == 'produits_calendrier' || $route == 'produits_panier') {
    		if($this->session->has('panier')) {
    			if($this->session->get('panier') == 0) {
    				$event->setResponse(new RedirectResponse($this->router->generate('panier')));
    			}
    		}
    		if(!is_object($this->securityContext->getToken()->getUser())) {
				$this->session->getFlashBag()->add('warning', 'Vous devez être connecté pour accéder à cette page.');
				$event->setResponse(new RedirectResponse($url));
			}
    	}
    }
}