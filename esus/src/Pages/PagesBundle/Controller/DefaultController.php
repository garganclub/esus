<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pages\PagesBundle\Form\RechercheType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $recuperePages = $em->getRepository('PagesBundle:Article')->findAll();        
        $pages = $this->get('knp_paginator')->paginate($recuperePages,$this->get('request')->query->get('page', 1),6); 
        return $this->render('PagesBundle:Default:index.html.twig', array(
        	'pages' => $pages
        ));
    }    
    public function pageAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('PagesBundle:Article')->find($id);        
        return $this->render('PagesBundle:Default:page.html.twig', array(
        	'page' => $page
        ));
    }    
    public function rechercheAction()
    {
        $form = $this->createForm(new RechercheType());        
        return $this->render('PagesBundle:Modules:recherche.html.twig', array(
        	'form' => $form->createView()
        ));
    }    
    public function recherchePagesAction()
    {
        $form = $this->createForm(new RechercheType());
        if($this->get('request')->getMethod() == 'POST') {
        	$form->bind($this->get('request'));
        }        
        $em = $this->getDoctrine()->getManager();
        $recuperePages = $em->getRepository('PagesBundle:Article')->recherche($form['recherche']->getData());
        
        if(sizeOf($recuperePages) == 0) {
        	$this->get('session')->getFlashBag()->add('warning', 'Aucun article ne correspond à votre recherche');
        }
        elseif(sizeOf($recuperePages) == 1) {
        	$this->get('session')->getFlashBag()->add('success', sizeOf($recuperePages).' article correspond à votre recherche');
        }
        else {
        	$this->get('session')->getFlashBag()->add('success', sizeOf($recuperePages).' articles correspondent à votre recherche');
        }        
        $pages = $this->get('knp_paginator')->paginate($recuperePages,$this->get('request')->query->get('page', 1),2);
        
        return $this->render('PagesBundle:Default:index.html.twig', array(
        	'pages' => $pages
        ));
    }
}