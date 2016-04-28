<?php

namespace EchangeoBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Inscrit
 *
 * @ORM\Table(name="Inscrit")
 * @ORM\Entity
 */
class Inscrit extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_de_naissance", type="date")
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     *
     * @ORM\OneToMany(targetEntity="Service", mappedBy="Inscrit", cascade={"remove", "persist"})
     */
    private $services;

    /**
     *
     * @ORM\OneToMany(targetEntity="Reponse", mappedBy="Inscrit", cascade={"remove", "persist"})
     */
    private $reponses;

    /**
     *
     * @ORM\OneToMany(targetEntity="Reponse", mappedBy="Inscrit", cascade={"remove", "persist"})
     */
    private $conversations;


    /**
     *
     * @ORM\OneToMany(targetEntity="Message", mappedBy="Inscrit", cascade={"remove", "persist"})
     */
    private $messages;

    /**
     *
     * @ORM\OneToMany(targetEntity="Evaluation", mappedBy="Inscrit", cascade={"remove", "persist"})
     */
    private $evaluations;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Inscrit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Inscrit
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return Inscrit
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Inscrit
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Add service
     *
     * @param \EchangeoBundle\Entity\Service $service
     * @return Inscrit
     */
    public function addService(\EchangeoBundle\Entity\Service $service)
    {
        $this->service[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \EchangeoBundle\Entity\Service $service
     */
    public function removeService(\EchangeoBundle\Entity\Service $service)
    {
        $this->service->removeElement($service);
    }

    /**
     * Get service
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Add reponse
     *
     * @param \EchangeoBundle\Entity\Reponse $reponse
     * @return Inscrit
     */
    public function addReponse(\EchangeoBundle\Entity\Reponse $reponse)
    {
        $this->reponse[] = $reponse;

        return $this;
    }

    /**
     * Remove reponse
     *
     * @param \EchangeoBundle\Entity\Reponse $reponse
     */
    public function removeReponse(\EchangeoBundle\Entity\Reponse $reponse)
    {
        $this->reponse->removeElement($reponse);
    }

    /**
     * Get reponse
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Get reponses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReponses()
    {
        return $this->reponses;
    }

    /**
     * Add conversations
     *
     * @param \EchangeoBundle\Entity\Reponse $conversations
     * @return Inscrit
     */
    public function addConversation(\EchangeoBundle\Entity\Reponse $conversations)
    {
        $this->conversations[] = $conversations;

        return $this;
    }

    /**
     * Remove conversations
     *
     * @param \EchangeoBundle\Entity\Reponse $conversations
     */
    public function removeConversation(\EchangeoBundle\Entity\Reponse $conversations)
    {
        $this->conversations->removeElement($conversations);
    }

    /**
     * Get conversations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConversations()
    {
        return $this->conversations;
    }

    /**
     * Add messages
     *
     * @param \EchangeoBundle\Entity\Massage $messages
     * @return Inscrit
     */
    public function addMessage(\EchangeoBundle\Entity\Massage $messages)
    {
        $this->messages[] = $messages;

        return $this;
    }

    /**
     * Remove messages
     *
     * @param \EchangeoBundle\Entity\Massage $messages
     */
    public function removeMessage(\EchangeoBundle\Entity\Massage $messages)
    {
        $this->messages->removeElement($messages);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Add evaluations
     *
     * @param \EchangeoBundle\Entity\Evaluation $evaluations
     * @return Inscrit
     */
    public function addEvaluation(\EchangeoBundle\Entity\Evaluation $evaluations)
    {
        $this->evaluations[] = $evaluations;

        return $this;
    }

    /**
     * Remove evaluations
     *
     * @param \EchangeoBundle\Entity\Evaluation $evaluations
     */
    public function removeEvaluation(\EchangeoBundle\Entity\Evaluation $evaluations)
    {
        $this->evaluations->removeElement($evaluations);
    }

    /**
     * Get evaluations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }
}
