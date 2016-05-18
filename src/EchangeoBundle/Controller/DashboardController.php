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
        $docServices = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
        $id = $this->getUser()->getId();
        $services = $docServices->findBy(array("inscrit" => $id), array('id' => 'desc'), 1, null);
        return $this->render('EchangeoBundle:Dashboard:dashboard.html.twig',array(
                "services"=>$services)
                );
    }

/*SERVICES*/ 
	/**
     * Page des services
     * @Route("/dashboard/services",
              name="servicesUser")
     */
    public function servicesUserAction()
    {
        $docServices = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
        $id = $this->getUser()->getId();
        $services = $docServices->findBy(array("inscrit" => $id), array('id' => 'desc'), null, null);
        return $this->render('EchangeoBundle:Dashboard:dashboardServices.html.twig',array(
                "services"=>$services)
                );
    }

}