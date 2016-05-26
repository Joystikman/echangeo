<?php

namespace EchangeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="EchangeoBundle\Repository\MessageRepository")
 */
class Message
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
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Conversation")
     * @ORM\JoinColumn(name="Conversation_id", referencedColumnName="id")
     */
    private $conversation;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Inscrit")
     * @ORM\JoinColumn(name="Inscrit_id", referencedColumnName="id")
     */
    private $inscrit;


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
     * Set contenu
     *
     * @param string $contenu
     * @return Message
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set inscrit
     *
     * @param \EchangeoBundle\Entity\Inscrit $inscrit
     * @return Message
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
     * Set conversation
     *
     * @param \EchangeoBundle\Entity\Conversation $conversation
     *
     * @return Message
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
