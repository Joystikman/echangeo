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
        /*test : temps d'execution du passage en JSON*/
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

/*RECHERCHE*/

    /**
     * Fonction d'obtention des sous-categories et des services d'une categorie
     * @Route("/api/recherche/{categorie}_{departement}_{keyword}_{profondeur}.{_format}",
     		  defaults = {"_format"="json", "departement"="null", "keyword"="null"},
     		  requirements = { "_format" = "html|json" },
              name="getRecherche",
     *  )
     * @Method({"GET"})
     */
    public function getRecherche($categorie, $departement, $keyword, $profondeur)
    {
    	/*Requete : on récupère les sous-catégorie d'un catégorie donnée*/
        $docSC = $this->getDoctrine()->getRepository('EchangeoBundle:SousCategorie');
        $sousCategories = $docSC->findBy(array('categorie' => $categorie), array(), null, null);

        /*Requete pour récupérer les services corrépondant à la recherche*/
        /*Si une catégorie et un département ont été renseignés*/
        if($categorie != "null" && $departement != "null"){
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'SELECT s
                FROM EchangeoBundle:Service s
                WHERE EXISTS(
                    SELECT sc
                    FROM EchangeoBundle:sousCategorie sc
                    WHERE sc.categorie = :categorie
                    AND s.sousCategorie = sc.id
                )
                AND s.departement = :dpt
                ORDER BY s.id DESC'
            )->setParameter('categorie', $categorie)
             ->setParameter('dpt', $departement);
            $servicesQuery = $query->getResult();
        }
        /*Si seulement une catégorie a été rensignée*/
        elseif ($categorie != "null" && $departement == "null") {
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'SELECT s
                FROM EchangeoBundle:Service s
                WHERE EXISTS(
                    SELECT sc
                    FROM EchangeoBundle:sousCategorie sc
                    WHERE sc.categorie = :categorie
                    AND s.sousCategorie = sc.id
                )
                ORDER BY s.id DESC'
            )->setParameter('categorie', $categorie);
            $servicesQuery = $query->getResult();
        }
        /*Si seulement un département a été rensigné*/
        elseif ($categorie == "null" && $departement != "null") {
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'SELECT s
                FROM EchangeoBundle:Service s
                WHERE s.departement = :dpt
                ORDER BY s.id DESC'
            )->setParameter('dpt', $departement);
            $servicesQuery = $query->getResult();
        }
        /*Si aucun des 2 critères n'a été rensaigné*/
        elseif ($categorie == "null" && $departement == "null") {
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'SELECT s
                FROM EchangeoBundle:Service s
                ORDER BY s.id DESC'
            );
            $servicesQuery = $query->getResult();
        }

        /*Tri des services répondant au mots clés rentrés*/
        $services = array();
        $listeKeyword = explode(" ", $keyword);
        if ($keyword != "null") {
            foreach ($listeKeyword as $word) {
                $index = 0;
                foreach ($servicesQuery as $s) {
                    /*Si la recherche en profondeur est activé, la recherche des mots clés se fait dans le titre et dans la description des services*/
                    if ($profondeur=="true" && (strpos(strtolower($s->getTitre()), strtolower($word)) || strpos(strtolower($s->getDescription()), strtolower($word)) )) {                        
                        $services[] = $s;
                        /*Une fois le service ajouté, on le retire de la liste parcouru pour éviter les doublons*/
                        unset($servicesQuery[$index]);
                        $index++;
                    }
                    elseif ($profondeur=="false" && strpos(strtolower($s->getTitre()), strtolower($word)) ) {
                        $services[] = $s;
                        unset($servicesQuery[$index]);
                        $index++;
                    }
                }
            }
        }
        else{
            $services = $servicesQuery;
        }

        /*Optimisation pour la transcription en JSON*/
        /*On ne garde que les attribut qui sont utiles*/
        $sousCategories_res = array();
        foreach ($sousCategories as $sc) {
            $sous_categorie = array('id' => $sc->getId(),
                                    'libelle'=> $sc->getLibelle(),
                                    'description'=> $sc->getDescription(),
            );
            $sousCategories_res[]=$sous_categorie;
        }

        $services_res = array();
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
                             'icone'=> $s->getSousCategorie()->getIcone(),
            );
            $services_res[]=$service;
        }
        $res = array('sousCategories' => $sousCategories_res,
                     'services' => $services_res,
        );
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
     * @Route("/api/serviceSousCategorie/{sousCategorie}_{categorie}_{departement}_{keyword}_{profondeur}.{_format}",
     		  defaults = {"_format"="json"},
     		  requirements = { "_format" = "html|json" },
              name="getServicesSousCategories",
     *  )
     * @Method({"GET"})
     */
    public function getServicesSousCategories($sousCategorie, $categorie, $departement, $keyword, $profondeur)
    {
    	/*Requete*/
        $docS = $this->getDoctrine()->getRepository('EchangeoBundle:Service');

        $ids = explode(",", $sousCategorie);
        /*Recherche des services appartenant aux sousCategorie selectionnées*/
        if ( $departement != "null") {
            $repository = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
            $query = $repository->createQueryBuilder('s')
            ->where("s.sousCategorie IN(:ids)")
            ->andWhere('s.departement = :dpt')
            ->setParameter('ids', array_values($ids))
            ->setParameter('dpt', $departement)
            ->orderBy('s.id', 'DESC')
            ->getQuery();

            $servicesQuery = $query->getResult();
        }
        else{
            $repository = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
            $query = $repository->createQueryBuilder('s')
            ->where("s.sousCategorie IN(:ids)")
            ->setParameter('ids', array_values($ids))
            ->orderBy('s.id', 'DESC')
            ->getQuery();

            $servicesQuery = $query->getResult();
        }

        /*Recherche des mots clés*/
        $services = array();
        $listeKeyword = explode(" ", $keyword);
        if ($keyword != "null") {
            foreach ($servicesQuery as $s) {
                foreach ($listeKeyword as $word) {
                    if ($profondeur && strpos(strtolower($s->getTitre()), strtolower($word)) || strpos(strtolower($s->getDescription()), strtolower($word))) {
                        $services[] = $s;
                    }
                    elseif ($profondeur && strpos(strtolower($s->getTitre()), strtolower($word))) {
                        $services[] = $s;
                    }
                }
            }
        }
        else{
            $services = $servicesQuery;
        }
        
        /*Optimisation des service*/
        $services_res = array();        	
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

        /*Optimisation pour le JSON*/
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

        $reponses = $service->getReponses();

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
        
        /*Modification de l'etat de la réponse si la date du rendez-vous est passé*/
        if($reponse->getDateRendezVous()< new \Datetime() && $reponse->getEtat()=="valide"){
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

        if($reponse->getDateRendezVous()<new \Datetime() && $reponse->getEtat()=="valide"){
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
