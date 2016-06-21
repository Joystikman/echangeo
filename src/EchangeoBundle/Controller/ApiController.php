<?php

namespace EchangeoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use \Datetime;
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
        $start = microtime(true);
        $serializer = $this->get('serializer');
		$jsonContent = $serializer->serialize($services, 'json');
        $time_elapsed_secs = microtime(true) - $start;
        print_r($time_elapsed_secs);
        return new Response(
            $jsonContent,
            200,
            array('Content-Type' => 'application/json')
        );
    }


    /**
     * Fonction d'obtention des sous-categories et des services d'une categorie
     * @Route("/api/sousCategorie/{id}.{_format}",
     		  defaults = {"_format"="json"},
     		  requirements = { "_format" = "html|json" },
              name="getSousCategories",
     *  )
     * @Method({"GET"})
     */
    public function getSousCategories($id)
    {
    	/*Requete : on récupère les sous-catégorie d'un catégorie donnée*/
        $docSC = $this->getDoctrine()->getRepository('EchangeoBundle:SousCategorie');
        $sousCategories = $docSC->findBy(array('categorie' => $id), array(), null, null);

        /*Optimisation*/
        $res = array();
        $services_res = array();
        foreach ($sousCategories as $sc) {
            $sous_categorie = array('id' => $sc->getId(),
                                    'libelle'=> $sc->getLibelle(),
                                    'description'=> $sc->getDescription(),
            );
            $res[]=$sous_categorie;
            $docS = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
            $services = $docS->findBy(array('sousCategorie' => $sc->getId()), array('fin'=>'desc'), null, null);
            foreach ($services as $s) {
                $service = array('id' => $s->getId(),
                                 'titre'=> $s->getTitre(),
                                 'description'=> $s->getDescription(),
                                 'debut'=> $s->getDebut(),
                                 'fin'=> $s->getFin(),
                                 'type'=> $s->getType(),
                                 'distance'=> $s->getDistance(),
                                 'adresse'=> $s->getAdresse(),
                                 'lieu'=> $s->getLieu(),
                                 'username'=> $s->getInscrit()->getUsername(),
                                 'icone'=> $sc->getIcone(),
                );
                $services_res[]=$service;
            }
        }
        $res[]=$services_res;
        /*passage en JSON avec Serializer*/
        $serializer = $this->get('serializer');
		$jsonContent = $serializer->serialize($res, 'json');
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
        $services_res = array();
        foreach ($ids as $categorie ) {        	
        	$services = $docS->findBy(array('sousCategorie' => $categorie), array(), null, null);
            foreach ($services as $s ) { 
                $service = array('id' => $s->getId(),
                                 'titre'=> $s->getTitre(),
                                 'description'=> $s->getDescription(),
                                 'debut'=> $s->getDebut(),
                                 'fin'=> $s->getFin(),
                                 'type'=> $s->getType(),
                                 'distance'=> $s->getDistance(),
                                 'adresse'=> $s->getAdresse(),
                                 'lieu'=> $s->getLieu(),
                                 'username'=> $s->getInscrit()->getUsername(),
                                 'icone'=> $s->getSousCategorie()->getIcone(),
                );
                $services_res[]=$service;
            }
        }
        /*passage en JSON avec Serializer*/
        $serializer = $this->get('serializer');
		$jsonContent = $serializer->serialize($services_res, 'json');

        return new Response(
            $jsonContent,
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Fonction d'obtention d'un service par son id
     * @Route("/api/service/{id}.{_format}",
              defaults = {"_format"="json"},
              requirements = { "_format" = "html|json" },
              name="getserviceID",
     *  )
     * @Method({"GET"})
     */
    public function getserviceID($id)
    {
        /*Requete*/
        $docS = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
        $service = $docS->find($id);

        /*$res = array();*/
        $res = array('id' => $service->getId(),
                         'titre'=> $service->getTitre(),
                         'description'=> $service->getDescription(),
                         'debut'=> $service->getDebut(),
                         'fin'=> $service->getFin(),
                         'type'=> $service->getType(),
                         'distance'=> $service->getDistance(),
                         'adresse'=> $service->getAdresse(),
                         'lieu'=> $service->getLieu(),
                         'userId'=> $service->getInscrit()->getId(),
                         'username'=> $service->getInscrit()->getUsername(),
                         'icone'=> $service->getSousCategorie()->getIcone(),
           );
        /*$res[]=$service;*/
    
        /*passage en JSON avec Serializer*/
        $serializer = $this->get('serializer');
        $jsonContent = $serializer->serialize($res, 'json');
        return new Response(
            $jsonContent,
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /*DASHBOARD*/
    /**
     * Fonction d'obtention d'un service par son id
     * @Route("/api/dashboard/service/{id}.{_format}",
              defaults = {"_format"="json"},
              requirements = { "_format" = "html|json" },
              name="getmonServiceID",
     *  )
     * @Method({"GET"})
     */
    public function getmonServiceID($id)
    {
        /*Requete*/
        $docS = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
        $service = $docS->find($id);

        /*$docR = $this->getDoctrine()->getRepository('EchangeoBundle:Reponse');*/
        /*$reponses = $docR->findBy(array('service' => $id), array('id'=>'desc'), null, null);*/
        $reponses = $service->getReponses();

        /*$res = array();*/
        $res = array('id' => $service->getId(),
                         'titre'=> $service->getTitre(),
                         'description'=> $service->getDescription(),
                         'debut'=> $service->getDebut(),
                         'fin'=> $service->getFin(),
                         'type'=> $service->getType(),
                         'distance'=> $service->getDistance(),
                         'adresse'=> $service->getAdresse(),
                         'lieu'=> $service->getLieu(),
                         'username'=> $service->getInscrit()->getUsername(),
                         'icone'=> $service->getSousCategorie()->getIcone(),
                         'reponses'=> array(),
            );
        foreach ($reponses as $reponse) {
            $r = array('id' => $reponse->getId(),
                       'username' => $reponse->getConversation()->getInterlocuteur2()->getUsername(),
                       'etat' => $reponse->getEtat(),
                       'date_rendez_vous' => $reponse->getDateRendezVous(),
                );
            $res['reponses'][]=$r;
        }
    
        /*passage en JSON avec Serializer*/
        $serializer = $this->get('serializer');
        $jsonContent = $serializer->serialize($res, 'json');
        return new Response(
            $jsonContent,
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Fonction d'obtention d'une réponse par son id
     * @Route("/api/reponse/dashboard/{id}.{_format}",
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
        $reponse = $docR->find($id);
        $messages = $reponse->getConversation()->getMessages();
        
        if($reponse->getDateRendezVous()< new \Datetime()){
            $etat = "notation";
        }
        else{
            $etat = $reponse->getEtat();
        }

        /*creation de la réponse*/
        $res = array('id' => $reponse->getId(),
                     'date_rendez_vous'=> $reponse->getDateRendezVous(),
                     'etat'=> $etat,
                     'username'=> $reponse->getConversation()->getInterlocuteur2()->getUsername(),
                     'conversationId'=> $reponse->getConversation()->getId(),
                     'messages'=> array(),
                     'evaluateurs'=> "",
            );
        foreach ($messages as $message) {
            $m = array('id' => $message->getId(),
                       'username' => $message->getInscrit()->getUsername(),
                       'contenu' => $message->getContenu(),
                );
            $res['messages'][]=$m;
        }

        /*creation des evaluations*/
        foreach ($reponse->getEvaluations() as $eval) {
            $res['evaluateurs'].=",".$eval->getInscritNotant()->getUsername();
        }

        /*passage en JSON avec Serializer*/
        $serializer = $this->get('serializer');
        $jsonContent = $serializer->serialize($res, 'json');

        return new Response(
            $jsonContent,
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * Fonction d'obtention d'une réponse d'un utilisateur par son id
     * @Route("/api/reponseUser/dashboard/{id}.{_format}",
              defaults = {"_format"="json"},
              requirements = { "_format" = "html|json" },
              name="getreponseUserID",
     *  )
     * @Method({"GET"})
     */
    public function getReponseUserID($id)
    {
        /*Requete - recuperation de la reponse brut*/
        $docR = $this->getDoctrine()->getRepository('EchangeoBundle:Reponse');
        $reponse = $docR->find($id);
        $messages = $reponse->getConversation()->getMessages();
        $serviceBrut = $reponse->getService();

        /*print_r(strtotime($reponse->getDateRendezVous())<strtotime(now()));*/
        if($reponse->getDateRendezVous()<new \Datetime()){
            $etat = "notation";
        }
        else{
            $etat = $reponse->getEtat();
        }

        /*creation de la réponse*/
        $res = array('id' => $reponse->getId(),
                     'date_rendez_vous'=> $reponse->getDateRendezVous(),
                     'etat'=> $etat,
                     'username'=> $reponse->getConversation()->getInterlocuteur2()->getUsername(),
                     'conversationId'=> $reponse->getConversation()->getId(),
                     'messages'=> array(),
                     'service'=> null,
                     'evaluateurs'=> "",
                     'evaluations'=> array(),
            );
        /*creation des messages*/
        foreach ($messages as $message) {
            $m = array('id' => $message->getId(),
                       'username' => $message->getInscrit()->getUsername(),
                       'contenu' => $message->getContenu(),
                );
            $res['messages'][]=$m;
        }
        /*creation des services*/
        $service = array('id' => $serviceBrut->getId(),
                         'titre'=> $serviceBrut->getTitre(),
                         'description'=> $serviceBrut->getDescription(),
                         'debut'=> $serviceBrut->getDebut(),
                         'fin'=> $serviceBrut->getFin(),
                         'type'=> $serviceBrut->getType(),
                         'distance'=> $serviceBrut->getDistance(),
                         'adresse'=> $serviceBrut->getAdresse(),
                         'lieu'=> $serviceBrut->getLieu(),
                         'username'=> $serviceBrut->getInscrit()->getUsername(),
            );

        /*creation des evaluations*/
        foreach ($reponse->getEvaluations() as $eval) {
            $e = array('id' => $eval->getId(),
                       'note' => $eval->getNote(),
                       'commentaire' => $eval->getCommentaire(),
                       'notant' => $eval->getInscritNotant()->getId(),
                       'note' => $eval->getInscritNote()->getId(),
                );
            $res['evaluations'][]=$e;
            $res['evaluateurs'].=",".$eval->getInscritNotant()->getUsername();
        }
        $res['service']=$service;

        /*passage en JSON avec Serializer*/
        $serializer = $this->get('serializer');
        $jsonContent = $serializer->serialize($res, 'json');

        return new Response(
            $jsonContent,
            200,
            array('Content-Type' => 'application/json')
        );
    }

}
