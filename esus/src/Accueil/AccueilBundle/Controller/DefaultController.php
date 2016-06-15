<?php

namespace Accueil\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AccueilBundle:Default:index.html.twig');
    }
    public function ateliersAction()
    {
        return $this->render('AccueilBundle:Default:ateliers.html.twig');
    }
    public function coworkingAction()
    {
        return $this->render('AccueilBundle:Default:coworking.html.twig');
    }
    public function reservationAction()
    {
        return $this->render('AccueilBundle:Default:reservation.html.twig');
    }
}