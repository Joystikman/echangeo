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
     * @ORM\Column(name="dateRendezVous", type="date")
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
     * @ORM\ManyToOne(targetEntity="Inscrit")
     * @ORM\JoinColumn(name="Inscrit_id", referencedColumnName="id")
     */
    private $inscrit;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumn(name="Service_id", referencedColumnName="id")
     */
    private $service;

    /**
     *
     * @ORM\OneToOne(targetEntity="Conversation", cascade={"remove"})
     * @ORM\JoinColumn(name="Conversation_id", referencedColumnName="id")
     */
    private $conversation ;


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
    public function setDateRendezVous($dateRendezVous)
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
}
