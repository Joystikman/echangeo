<?php

namespace EchangeoBundle\Controller;

/*appel des entitées*/
use EchangeoBundle\Entity\Categorie;
use EchangeoBundle\Entity\Service;
use EchangeoBundle\Entity\Reponse;
use EchangeoBundle\Entity\Inscrit;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
/*FONCTIONS DE TEST*/
    /*@Security("has_role('ROLE_ADMIN')")*/
    /**
     * @Route("/test",
              name="test")
     */
    public function testAction()
    {
    	$docService = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
		$services = $docService->findAll();
		$docUser = $this->getDoctrine()->getRepository('EchangeoBundle:Inscrit');
		$inscrits = $docUser->findAll();
        return $this->render('EchangeoBundle:Default:test.html.twig', array(
        		"services"=>$services,
        		"inscrits"=>$inscrits));
    }
    
/*ACCUEIL*/ 

    /**
     * Page d'accueil
     * @Route("/",
              name="index")
     */
    public function indexAction()
    {
        $docService = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
        $services = $docService->findAll();
        return $this->render('EchangeoBundle:Default:index.html.twig',array(
                "services"=>$services)
                );
    }

/*RECHERCHE DE SERVICES*/
    /**
     * Page de recherche de service
     * @Route("/recherche",
              name="recherche_service")
     */
    public function rechercheAction()
    {
    /*On récupère les categories*/
        $docCategories = $this->getDoctrine()->getRepository('EchangeoBundle:Categorie');
        $categories = $docCategories->findAll();
    /*On recupère les derniers services*/
        $docServices = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
        $services = $docServices->findBy(array(), array('id' => 'desc'), 4, null);
    /*rendu*/
        return $this->render('EchangeoBundle:Default:recherche.html.twig',array(
                "categories"=>$categories,
                "services"=>$services)
                );
    }


}
