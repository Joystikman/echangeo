<?php

namespace EchangeoBundle\Controller;

/*appel des entitées*/
use EchangeoBundle\Entity\Categorie;
use EchangeoBundle\Entity\Service;
use EchangeoBundle\Entity\Reponse;
use EchangeoBundle\Entity\Inscrit;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DashboardController extends Controller
{

/*ACCUEIL*/ 
	/**
     * Page d'accueil
     * @Route("/dashboard",
              name="dashboard")
     */
    public function dashboardAction()
    {
        /*$docServices = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
        $services = $docServices->findBy(array(), array('id' => 'desc'), 4, null);*/
        return $this->render('EchangeoBundle:Dashboard:dashboard.html.twig',array(
                "test"=>"test")
                );
    }

}