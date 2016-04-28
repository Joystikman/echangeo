<?php

namespace EchangeoBundle\Controller;

/*appel des entitées*/
use EchangeoBundle\Entity\Categorie;

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
    	$docCategorie = $this->getDoctrine()->getRepository('EchangeoBundle:Categorie');
		$categories = $docCategorie->findAll();
		$docSC = $this->getDoctrine()->getRepository('EchangeoBundle:SousCategorie');
		$sc = $docSC->findAll();
        return $this->render('EchangeoBundle:Default:test.html.twig', array(
        		"categories"=>$categories,
        		"souscategories"=>$sc));
    }
}
