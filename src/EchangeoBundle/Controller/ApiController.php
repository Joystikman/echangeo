<?php

namespace EchangeoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
/*Serializer*/
/*use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;*/
/*JMSSerializer*/
use JMS\Serializer\SerializerBuilder;

class ApiController extends Controller
{
	/*NOTES :*/
    /*lien vers la fonction {{ path('nomFonction',{ 'nomParam': entite.attribut }) }}*/

	/**
     * Fonction d'obtention des Services
     * @Route("/api/services",
              name="getAllServices")
     */
    public function getAllServices()
    {
        /*Requete*/
        $docService = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
        $services = $docService->findAll();
        /*Serialisation*/
        $serializer = $this->get('serializer');
		$jsonContent = $serializer->serialize($services, 'json');
        return new Response(
            $jsonContent,
            200,
            array('Content-Type' => 'application/json')
        );
    }


    /**
     * Fonction d'obtention des sous-categories
     * @Route("/api/sousCategorie/{id}.{_format}",
     		  defaults = {"_format"="json"},
     		  requirements = { "_format" = "html|json" },
              name="getSousCategories",
     *  )
     * @Method({"GET"})
     */
    public function getSousCategories($id)
    {
    	/*Requete*/
        $docSC = $this->getDoctrine()->getRepository('EchangeoBundle:SousCategorie');
        $sousCategories = $docSC->findBy(array('categorie' => $id), array(), null, null);
        /*passage en JSON avec Serializer*/
        /*$encoder = new JsonEncoder();
		$normalizer = new GetSetMethodNormalizer();
		$normalizer->setIgnoredAttributes(array('match'));
		$serializer = new Serializer(array($normalizer), array($encoder));
        $jsonContent = $serializer->serialize($sousCategories, 'json');*/
        /*Avec JMSSerializer*/
        $serializer = $this->get('serializer');
		$jsonContent = $serializer->serialize($sousCategories, 'json');

        return new Response(
            $jsonContent,
            200,
            array('Content-Type' => 'application/json')
        );
    }
}
