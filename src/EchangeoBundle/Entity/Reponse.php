<?php

namespace EchangeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse")
 * @ORM\Entity(repositoryClass="EchangeoBundle\Repository\ReponseRepository")
 */
class Reponse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateRendezVous", type="date", nullable=true)
     */
    private $dateRendezVous;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Inscrit", inversedBy="reponses")
     * @ORM\JoinColumn(name="Inscrit_id", referencedColumnName="id")
     */
    private $inscrit;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="reponses")
     * @ORM\JoinColumn(name="Service_id", referencedColumnName="id")
     */
    private $service;

    /**
     *
     * @ORM\OneToOne(targetEntity="Conversation", inversedBy="reponse", cascade={"remove"})
     * @ORM\JoinColumn(name="Conversation_id", referencedColumnName="id")
     */
    private $conversation ;

    /**
     *
     * @ORM\OneToMany(targetEntity="Evaluation", mappedBy="reponse", cascade={"remove", "persist"})
     *
     */
    private $evaluations;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateRendezVous
     *
     * @param \DateTime $dateRendezVous
     * @return Reponse
     */
    public function setDateRendezVous($dateRendezVous = null)
    {
        $this->dateRendezVous = $dateRendezVous;

        return $this;
    }

    /**
     * Get dateRendezVous
     *
     * @return \DateTime 
     */
    public function getDateRendezVous()
    {
        return $this->dateRendezVous;
    }

    /**
     * Set etat
     *
     * @param string $etat
     * @return Reponse
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string 
     */
    public function getEtat()
    {
        return $this->etat;
    }


    /**
     * Set inscrit
     *
     * @param \EchangeoBundle\Entity\Inscrit $inscrit
     * @return Reponse
     */
    public function setInscrit(\EchangeoBundle\Entity\Inscrit $inscrit = null)
    {
        $this->inscrit = $inscrit;

        return $this;
    }

    /**
     * Get inscrit
     *
     * @return \EchangeoBundle\Entity\Inscrit 
     */
    public function getInscrit()
    {
        return $this->inscrit;
    }

    /**
     * Set service
     *
     * @param \EchangeoBundle\Entity\Service $service
     * @return Reponse
     */
    public function setService(\EchangeoBundle\Entity\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \EchangeoBundle\Entity\Service 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set conversation
     *
     * @param \EchangeoBundle\Entity\Conversation $conversation
     * @return Reponse
     */
    public function setConversation(\EchangeoBundle\Entity\Conversation $conversation = null)
    {
        $this->conversation = $conversation;

        return $this;
    }

    /**
     * Get conversation
     *
     * @return \EchangeoBundle\Entity\Conversation 
     */
    public function getConversation()
    {
        return $this->conversation;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evaluations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add evaluation
     *
     * @param \EchangeoBundle\Entity\Evaluation $evaluation
     *
     * @return Reponse
     */
    public function addEvaluation(\EchangeoBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluations[] = $evaluation;

        return $this;
    }

    /**
     * Remove evaluation
     *
     * @param \EchangeoBundle\Entity\Evaluation $evaluation
     */
    public function removeEvaluation(\EchangeoBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluations->removeElement($evaluation);
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
