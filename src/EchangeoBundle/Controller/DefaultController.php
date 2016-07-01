<?php

namespace EchangeoBundle\Controller;

/*appel des entitées*/
use EchangeoBundle\Entity\Categorie;
use EchangeoBundle\Entity\Service;
use EchangeoBundle\Entity\Reponse;
use EchangeoBundle\Entity\Inscrit;
use EchangeoBundle\Entity\Conversation;
use EchangeoBundle\Entity\Message;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

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
        $docServices = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
        /*on recupère les 4 dernieres annonces*/
        $services = $docServices->findBy(array(), array('id' => 'desc'), 4, null);
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
        $services = $docServices->findBy(array(), array('id' => 'desc'), 5, null);
    /*rendu*/
        return $this->render('EchangeoBundle:Default:recherche.html.twig',array(
                "categories"=>$categories,
                "services"=>$services)
                );
    }

    /**
     * Page de recherche d'un service donne
     * @Route("/recherche/service/{id}",
              name="recherche_service_id")
     */
    public function rechercheServiceAction($id)
    {
    /*On récupère les categories*/
        $docCategories = $this->getDoctrine()->getRepository('EchangeoBundle:Categorie');
        $categories = $docCategories->findAll();
    /*On recupère le service souhaité*/
        $docS = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
        $service[] = $docS->find($id);
    /*rendu*/
        return $this->render('EchangeoBundle:Default:rechercheService.html.twig',array(
                "categories"=>$categories,
                "services"=>$service)
                );
    }

    /**
     * Route du formulaire de réponse à un service
     * @Route("/recherche/reponse",
              name="reponse_service")
     * @Method({"POST"})
     */
    public function reponseAction(Request $request)
    {
      /*On créé les entités vierges*/
      $reponse = new Reponse();
      $conversation = new Conversation();
      $message = new Message();
      $docS = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
      $service = $docS->find($request->request->get('idService'));
      
      /*On créé un objet date avec la date rentré dans le formulaire*/
      $dateRDV = new \DateTime($request->request->get('dateRDV'));

      /*On défini les attributs de l'objet réponse*/
      $reponse->setDateRendezVous($dateRDV);
      $reponse->setEtat('attente');
      $reponse->setInscrit($this->getUser());
      $reponse->setService($service);
      $reponse->setConversation($conversation);

      /*On défini les attributs de l'objet conversation*/
      $conversation->setInterlocuteur1($service->getInscrit());
      $conversation->setInterlocuteur2($this->getUser());

      /*On défini les attributs de l'objet message*/
      $message->setContenu($request->request->get('message'));
      $message->setInscrit($this->getUser());
      $message->setConversation($conversation);

      /*On enregistre dans la Base de données les objets*/
      $em = $this->getDoctrine()->getManager();
      $em->persist($reponse);
      $em->persist($conversation);
      $em->persist($message);
      $em->flush();

    /*On renvoie vers la page de recherche*/
      return $this->redirectToRoute('recherche_service');
      return $this->render('EchangeoBundle:Default:recherche.html.twig',array(
                "categories"=>$categories,
                "services"=>$services)
                );
    }

    


}
