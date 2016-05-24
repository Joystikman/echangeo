<?php

namespace EchangeoBundle\Controller;

/*appel des entitées*/
use EchangeoBundle\Entity\Categorie;
use EchangeoBundle\Entity\Service;
use EchangeoBundle\Entity\Reponse;
use EchangeoBundle\Entity\Inscrit;

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

}