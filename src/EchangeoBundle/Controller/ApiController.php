<?php

namespace EchangeoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ApiController extends Controller
{
	/**
     * Fonction d'obtention des Services
     * @Route("/api/services",
              name="getAllServices")
     */
    public function getAllServices()
    {
        $docService = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
        $services = $docService->findAll();
        print_r($services);
        return $services;
    }


    /**
     * Fonction d'obtention des sous-categories
     * @Route("/api/sousCategorie/{id}",
              name="getSousCategories")
     */
    /*lien vers la fonction {{ path('nomFonction',{ 'nomParam': entite.attribut }) }}*/
    public function getSousCategories($id)
    {
        $docSC = $this->getDoctrine()->getRepository('EchangeoBundle:SousCategorie');
        $sousCategories = $docSC->findBy(array('categorie' => $id), array(), null, null);
        return $sousCategories;
    }
}
