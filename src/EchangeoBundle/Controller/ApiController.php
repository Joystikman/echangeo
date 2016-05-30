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
        $serializer = $this->get('serializer');
		$jsonContent = $serializer->serialize($sousCategories, 'json');

        return new Response(
            $jsonContent,
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Fonction d'obtention des services d'une sous-categories choisie
     * @Route("/api/serviceSousCategorie/{id}.{_format}",
     		  defaults = {"_format"="json"},
     		  requirements = { "_format" = "html|json" },
              name="getServicesSousCategories",
     *  )
     * @Method({"GET"})
     */
    public function getServicesSousCategories($id)
    {
    	/*Requete*/
        $docS = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
        /*Parse des arguments*/
        $ids = explode(",", $id);
        /*Requetes*/
        $services = array();
        foreach ($ids as $categorie ) {        	
        	array_push($services, $docS->findBy(array('sousCategorie' => $categorie), array(), null, null));
        }
        /*passage en JSON avec Serializer*/
        $serializer = $this->get('serializer');
		$jsonContent = $serializer->serialize($services, 'json');

        return new Response(
            $jsonContent,
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /*DASHBOARD*/
    /**
     * Fonction d'obtention d'un service par son id
     * @Route("/api/service/{id}.{_format}",
              defaults = {"_format"="json"},
              requirements = { "_format" = "html|json" },
              name="getserviceID",
     *  )
     * @Method({"GET"})
     */
    public function getServiceID($id)
    {
        /*Requete*/
        $docS = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
        $services = $docS->find($id);
        /*passage en JSON avec Serializer*/
        $serializer = $this->get('serializer');
        $jsonContent = $serializer->serialize($services, 'json');

        return new Response(
            $jsonContent,
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Fonction d'obtention d'une réponse par son id
     * @Route("/api/reponse/{id}.{_format}",
              defaults = {"_format"="json"},
              requirements = { "_format" = "html|json" },
              name="getreponseID",
     *  )
     * @Method({"GET"})
     */
    public function getReponseID($id)
    {
        /*Requete*/
        $docR = $this->getDoctrine()->getRepository('EchangeoBundle:Reponse');
        $reponses = $docR->find($id);
        /*passage en JSON avec Serializer*/
        $serializer = $this->get('serializer');
        $jsonContent = $serializer->serialize($reponses, 'json');

        return new Response(
            $jsonContent,
            200,
            array('Content-Type' => 'application/json')
        );
    }

}
