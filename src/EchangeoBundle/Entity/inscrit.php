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
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_de_naissance", type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     *
     * @ORM\OneToMany(targetEntity="Service", mappedBy="inscrit", cascade={"remove", "persist"})
     */
    private $services;

    /**
     *
     * @ORM\OneToMany(targetEntity="Reponse", mappedBy="inscrit", cascade={"remove", "persist"})
     */
    private $reponses;

    /**
     *
     * @ORM\OneToMany(targetEntity="Reponse", mappedBy="inscrit", cascade={"remove", "persist"})
     */
    private $conversations;


    /**
     *
     * @ORM\OneToMany(targetEntity="Message", mappedBy="inscrit", cascade={"remove", "persist"})
     */
    private $messages;

    /**
     *
     * @ORM\OneToMany(targetEntity="Evaluation", mappedBy="inscrit", cascade={"remove", "persist"})
     */
    private $evaluations;

    /**
     *
     * @ORM\OneToMany(targetEntity="SuggestionCategorie", mappedBy="inscrit", cascade={"remove", "persist"})
     */
    private $suggestions;

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
     * Add services
     *
     * @param \EchangeoBundle\Entity\Service $services
     * @return Inscrit
     */
    public function addService(\EchangeoBundle\Entity\Service $services)
    {
        $this->services[] = $services;

        return $this;
    }

    /**
     * Remove services
     *
     * @param \EchangeoBundle\Entity\Service $services
     */
    public function removeService(\EchangeoBundle\Entity\Service $services)
    {
        $this->services->removeElement($services);
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
     * Add reponses
     *
     * @param \EchangeoBundle\Entity\Reponse $reponses
     * @return Inscrit
     */
    public function addReponse(\EchangeoBundle\Entity\Reponse $reponses)
    {
        $this->reponses[] = $reponses;

        return $this;
    }

    /**
     * Remove reponses
     *
     * @param \EchangeoBundle\Entity\Reponse $reponses
     */
    public function removeReponse(\EchangeoBundle\Entity\Reponse $reponses)
    {
        $this->reponses->removeElement($reponses);
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
     * @param \EchangeoBundle\Entity\Message $messages
     * @return Inscrit
     */
    public function addMessage(\EchangeoBundle\Entity\Message $messages)
    {
        $this->messages[] = $messages;

        return $this;
    }

    /**
     * Remove messages
     *
     * @param \EchangeoBundle\Entity\Message $messages
     */
    public function removeMessage(\EchangeoBundle\Entity\Message $messages)
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

    /**
     * Add suggestions
     *
     * @param \EchangeoBundle\Entity\SuggestionCategorie $suggestions
     * @return Inscrit
     */
    public function addSuggestion(\EchangeoBundle\Entity\SuggestionCategorie $suggestions)
    {
        $this->suggestions[] = $suggestions;

        return $this;
    }

    /**
     * Remove suggestions
     *
     * @param \EchangeoBundle\Entity\SuggestionCategorie $suggestions
     */
    public function removeSuggestion(\EchangeoBundle\Entity\SuggestionCategorie $suggestions)
    {
        $this->suggestions->removeElement($suggestions);
    }

    /**
     * Get suggestions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSuggestions()
    {
        return $this->suggestions;
    }
}
