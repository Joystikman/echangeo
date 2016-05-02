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
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('EchangeoBundle:Default:index.html.twig');
    }

    /**
     * @Route("/test")
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
}
