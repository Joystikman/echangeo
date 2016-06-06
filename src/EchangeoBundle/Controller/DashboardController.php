<?php

namespace EchangeoBundle\Controller;

/*appel des entitées*/
use EchangeoBundle\Entity\Categorie;
use EchangeoBundle\Entity\Service;
use EchangeoBundle\Entity\Reponse;
use EchangeoBundle\Entity\Inscrit;
use EchangeoBundle\Entity\Message;
use EchangeoBundle\Entity\Evaluation;

/*appel des formulaires*/
use EchangeoBundle\Form\ServiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/*appel des gestionnaires*/
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * Ajout de services
     * @Route("/dashboard/services/new",
              name="addServices")
     */
    public function addServicesAction(Request $request)
    {
      $service = new Service();

      $docSC = $this->getDoctrine()->getRepository('EchangeoBundle:SousCategorie');
      $sousCategories = $docSC->findAll();

      /*creer le formulaire*/
      $formulaire = $this->createFormBuilder($service)
                ->add('titre', TextType::class)
                ->add('sousCategorie', EntityType::class,array('mapped' => true,
                                                         'required' => true,
                                                         'multiple' => false,
                                                         'expanded' => false,
                                                         'class' => 'EchangeoBundle:SousCategorie',
                                                         'choice_label' => 'libelle' ))
                ->add('description', TextareaType::class)
                ->add('debut', DateType::class, array(
                            'widget'  => 'single_text',
                            'format' => 'dd/MM/yyyy',
                        ))
                ->add('fin', DateType::class, array(
                            'widget'  => 'single_text',
                            'format' => 'dd/MM/yyyy',
                        ))
                ->add('type', ChoiceType::class, array('choices' => array(
                      'propose' => 'propose',
                      'demande' => 'demande')))
                ->add('lieu', TextareaType::class)
                ->add('distance', IntegerType::class)
                ->add('save', SubmitType::class, array('label' => 'Creer une annonce'))
                ->getForm();

      /*gestion des réponses*/
      $formulaire->handleRequest($request);

      if ($formulaire->isSubmitted() && $formulaire->isValid()) {
        $service->setInscrit($this->getUser());
        print_r("ça marche");
        $em = $this->getDoctrine()->getManager();
        $em->persist($service);
        $em->flush();
        return $this->redirectToRoute('servicesUser');
      }

      /*get des service de l'utilisateur*/
      $docServices = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
      $id = $this->getUser()->getId();
      $services = $docServices->findBy(array("inscrit" => $id), array('id' => 'desc'), null, null);
      return $this->render('EchangeoBundle:Dashboard:dashboardServicesAjout.html.twig',array(
              "form"=>$formulaire->createView(),
              "services"=>$services)
              );
    }

    /**
     * Modification et suppression de services
     * @Route("/dashboard/services/edit/{id}",
              name="editServices")
     */
    public function editServicesAction(Request $request, $id)
    {
      /*$service = new Service();*/

      $docS = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
      $service = $docS->find($id);

      /*creer le formulaire*/
      $formulaire = $this->createFormBuilder($service)
                ->add('titre', TextType::class)
                ->add('sousCategorie', EntityType::class,array('mapped' => true,
                                                         'required' => true,
                                                         'multiple' => false,
                                                         'expanded' => false,
                                                         'class' => 'EchangeoBundle:SousCategorie',
                                                         /*'choice_value' => 'id',*/
                                                         'choice_label' => 'libelle' ))
                ->add('description', TextareaType::class)
                ->add('debut', DateType::class, array(
                            'widget'  => 'single_text',
                            'format' => 'dd/MM/yyyy',
                        ))
                ->add('fin', DateType::class, array(
                            'widget'  => 'single_text',
                            'format' => 'dd/MM/yyyy',
                        ))
                ->add('type', ChoiceType::class, array('choices' => array(
                      'propose' => 'propose',
                      'demande' => 'demande')))
                ->add('lieu', TextareaType::class)
                ->add('distance', IntegerType::class)
                ->add('save', SubmitType::class, array('label' => "enregistrer les modifications"))
                ->add('delete', SubmitType::class, array('label' => "supprimer"))
                ->getForm();

      /*gestion des réponses*/
      $formulaire->handleRequest($request);

      if ($formulaire->isSubmitted() && $formulaire->isValid() && $formulaire->get('save')->isClicked()) {
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('servicesUser');
      }
      elseif ($formulaire->isSubmitted() && $formulaire->isValid() && $formulaire->get('delete')->isClicked()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($service);
        $em->flush();
        return $this->redirectToRoute('servicesUser');
      }

      /*get des service de l'utilisateur*/
      $docServices = $this->getDoctrine()->getRepository('EchangeoBundle:Service');
      $id = $this->getUser()->getId();
      $services = $docServices->findBy(array("inscrit" => $id), array('id' => 'desc'), null, null);
      return $this->render('EchangeoBundle:Dashboard:dashboardServicesAjout.html.twig',array(
              "form"=>$formulaire->createView(),
              "services"=>$services)
              );
    }

/*REPONSES*/
/**
     * Page des services
     * @Route("/dashboard/reponses",
              name="reponsesUser")
     */
    public function reponsesUserAction()
    {
        $docReponses = $this->getDoctrine()->getRepository('EchangeoBundle:Reponse');
        $id = $this->getUser()->getId();
        $reponses = $docReponses->findBy(array("inscrit" => $id), array('id' => 'desc'), null, null);
        return $this->render('EchangeoBundle:Dashboard:dashboardReponses.html.twig',array(
                "reponses"=>$reponses)
                );
    } 

/*MESSAGES*/
  /**
     * envoie de message conversation
     * @Route("/dashboard/send",
              name="sendMessage")
     * @Method({"POST"})
     */
    public function sendAction(Request $request)
    {
      //print_r($request->request->get('message'));
    /*On enregistre le réponse*/
      $message = new Message();
      $docC = $this->getDoctrine()->getRepository('EchangeoBundle:Conversation');
      $conversation = $docC->find($request->request->get('idConversation'));
      
      $message->setContenu($request->request->get('message'));
      $message->setInscrit($this->getUser());
      $message->setConversation($conversation);

      $em = $this->getDoctrine()->getManager();
      $em->persist($message);
      $em->flush();

    /*On renvoie vers la page de recherche*/
    if ($request->request->get('page')==="reponse") {
      return $this->redirectToRoute('reponsesUser');
    }
    else{
      return $this->redirectToRoute('servicesUser');
    }
  }

/*VALIDATION REPONSE*/
  /**
     * validation d'une réponse 
     * @Route("/dashboard/validation",
              name="validation")
     * @Method({"POST"})
     */
    public function validationAction(Request $request)
    {
      //print_r($request->request->get('message'));
      /*On enregistre le réponse*/
      $docR = $this->getDoctrine()->getRepository('EchangeoBundle:Reponse');
      $reponse = $docR->find($request->request->get('idReponse'));

      print_r($request->request->get('valide'));

      if ($request->request->get('valide')) {
        $reponse->setEtat('valide');
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('servicesUser');
      }
      elseif ($request->request->get('decline')) {
        $reponse->setEtat('refuse');
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('servicesUser');
      }
    }

/*NOTATION*/
  /**
     * notation d'un service 
     * @Route("/dashboard/notation",
              name="notation")
     * @Method({"POST"})
     */
    public function notationAction(Request $request)
    {
      /*On enregistre le réponse*/
      $docR = $this->getDoctrine()->getRepository('EchangeoBundle:Reponse');
      $reponse = $docR->find($request->request->get('idReponse'));

      $evaluation = new Evaluation();
      $evaluation->setNote($request->request->get('note'));
      $evaluation->setCommentaire($request->request->get('commentaire'));
      $evaluation->setInscritNotant($this->getUser());
      $evaluation->setService($reponse->getService());

      if ($request->request->get('page')=="services") {
        $evaluation->setInscritNote($reponse->getInscrit());
        $em = $this->getDoctrine()->getManager();
        $em->persist($evaluation);
        $em->flush();
        return $this->redirectToRoute('servicesUser');
      }
      elseif ($request->request->get('page')=="reponses") {
        $evaluation->setInscritNote($reponse->getService()->getInscrit());
        $em = $this->getDoctrine()->getManager();
        $em->persist($evaluation);
        $em->flush();
        //return $this->redirectToRoute('reponsesUser');
      }
    }
}