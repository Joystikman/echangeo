<?php

namespace EchangeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluation
 *
 * @ORM\Table(name="evaluation")
 * @ORM\Entity(repositoryClass="EchangeoBundle\Repository\EvaluationRepository")
 */
class Evaluation
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
     * @var int
     *
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255)
     */
    private $commentaire;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Inscrit", inversedBy="evaluationsDonnees")
     * @ORM\JoinColumn(name="Inscrit_id_notant", referencedColumnName="id")
     */
    private $inscritNotant;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Inscrit", inversedBy="evaluationsRecus")
     * @ORM\JoinColumn(name="Inscrit_id_note", referencedColumnName="id")
     */
    private $inscritNote;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Reponse", inversedBy="evaluations")
     * @ORM\JoinColumn(name="Reponse_id", referencedColumnName="id")
     */
    private $reponse;

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
     * Set note
     *
     * @param integer $note
     * @return Evaluation
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Evaluation
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }


    /**
     * Set inscritNotant
     *
     * @param \EchangeoBundle\Entity\Inscrit $inscritNotant
     * @return Evaluation
     */
    public function setInscritNotant(\EchangeoBundle\Entity\Inscrit $inscritNotant = null)
    {
        $this->inscritNotant = $inscritNotant;

        return $this;
    }

    /**
     * Get inscritNotant
     *
     * @return \EchangeoBundle\Entity\Inscrit 
     */
    public function getInscritNotant()
    {
        return $this->inscritNotant;
    }

    /**
     * Set inscritNote
     *
     * @param \EchangeoBundle\Entity\Inscrit $inscritNote
     * @return Evaluation
     */
    public function setInscritNote(\EchangeoBundle\Entity\Inscrit $inscritNote = null)
    {
        $this->inscritNote = $inscritNote;

        return $this;
    }

    /**
     * Get inscritNote
     *
     * @return \EchangeoBundle\Entity\Inscrit 
     */
    public function getInscritNote()
    {
        return $this->inscritNote;
    }


    /**
     * Set reponse
     *
     * @param \EchangeoBundle\Entity\Reponse $reponse
     *
     * @return Evaluation
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
}
