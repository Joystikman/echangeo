<?php

namespace EchangeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conversation
 *
 * @ORM\Table(name="conversation")
 * @ORM\Entity(repositoryClass="EchangeoBundle\Repository\ConversationRepository")
 */
class Conversation
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
     *
     * @ORM\OneToOne(targetEntity="Reponse", mappedBy="conversation", cascade={"remove", "persist"})
     */
    private $reponse;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Inscrit", cascade={"remove"})
     * @ORM\JoinColumn(name="Inscrit_id1", referencedColumnName="id")
     */
    private $interlocuteur1;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Inscrit", cascade={"remove"})
     * @ORM\JoinColumn(name="Inscrit_id2", referencedColumnName="id")
     */
    private $interlocuteur2;


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
     * Set reponse
     *
     * @param \EchangeoBundle\Entity\Reponse $reponse
     * @return Conversation
     */
    public function setReponse(\EchangeoBundle\Entity\Reponse $reponse = null)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return \EchangeoBundle\Entity\Reponse 
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set interlocuteur1
     *
     * @param \EchangeoBundle\Entity\Inscrit $interlocuteur1
     * @return Conversation
     */
    public function setInterlocuteur1(\EchangeoBundle\Entity\Inscrit $interlocuteur1 = null)
    {
        $this->interlocuteur1 = $interlocuteur1;

        return $this;
    }

    /**
     * Get interlocuteur1
     *
     * @return \EchangeoBundle\Entity\Inscrit 
     */
    public function getInterlocuteur1()
    {
        return $this->interlocuteur1;
    }

    /**
     * Set interlocuteur2
     *
     * @param \EchangeoBundle\Entity\Inscrit $interlocuteur2
     * @return Conversation
     */
    public function setInterlocuteur2(\EchangeoBundle\Entity\Inscrit $interlocuteur2 = null)
    {
        $this->interlocuteur2 = $interlocuteur2;

        return $this;
    }

    /**
     * Get interlocuteur2
     *
     * @return \EchangeoBundle\Entity\Inscrit 
     */
    public function getInterlocuteur2()
    {
        return $this->interlocuteur2;
    }
}
