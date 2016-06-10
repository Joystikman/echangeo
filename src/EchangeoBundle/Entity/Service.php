<?php

namespace EchangeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="EchangeoBundle\Repository\ServiceRepository")
 */
class Service
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="date")
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="date")
     */
    private $fin;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var float
     *
     * @ORM\Column(name="distance", type="float")
     */
    private $distance;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Inscrit", inversedBy="services")
     * @ORM\JoinColumn(name="Inscrit_id", referencedColumnName="id")
     *
     */
    private $inscrit;

    /**
     *
     * @ORM\ManyToOne(targetEntity="SousCategorie", inversedBy="services")
     * @ORM\JoinColumn(name="SousCategorie_id", referencedColumnName="id")
     *
     */
    private $sousCategorie;

    /**
     *
     * @ORM\OneToMany(targetEntity="Reponse", mappedBy="service", cascade={"remove", "persist"})
     */
    private $reponses;

    /**
     *
     * @ORM\OneToOne(targetEntity="Evaluation")
     * @ORM\JoinColumn(name="Evaluation_id_notant", referencedColumnName="id")
     *
     */
    private $evaluationNotant;

    /**
     *
     * @ORM\OneToOne(targetEntity="Evaluation")
     * @ORM\JoinColumn(name="Evaluation_id_note", referencedColumnName="id")
     *
     */
    private $evaluationNote;


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
     * Set titre
     *
     * @param string $titre
     * @return Service
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Service
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     * @return Service
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime 
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     * @return Service
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime 
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Service
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     * @return Service
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string 
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set distance
     *
     * @param float $distance
     * @return Service
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return float 
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reponses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set inscrit
     *
     * @param \EchangeoBundle\Entity\Inscrit $inscrit
     * @return Service
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
     * Set sousCategorie
     *
     * @param \EchangeoBundle\Entity\SousCategorie $sousCategorie
     * @return Service
     */
    public function setSousCategorie(\EchangeoBundle\Entity\SousCategorie $sousCategorie = null)
    {
        $this->sousCategorie = $sousCategorie;

        return $this;
    }

    /**
     * Get sousCategorie
     *
     * @return \EchangeoBundle\Entity\SousCategorie 
     */
    public function getSousCategorie()
    {
        return $this->sousCategorie;
    }

    /**
     * Add reponses
     *
     * @param \EchangeoBundle\Entity\Reponse $reponses
     * @return Service
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
     * Set evaluationNotant
     *
     * @param \EchangeoBundle\Entity\Evaluation $evaluationNotant
     * @return Service
     */
    public function setEvaluationNotant(\EchangeoBundle\Entity\Evaluation $evaluationNotant = null)
    {
        $this->evaluationNotant = $evaluationNotant;

        return $this;
    }

    /**
     * Get evaluationNotant
     *
     * @return \EchangeoBundle\Entity\Evaluation 
     */
    public function getEvaluationNotant()
    {
        return $this->evaluationNotant;
    }

    /**
     * Set evaluationNote
     *
     * @param \EchangeoBundle\Entity\Evaluation $evaluationNote
     * @return Service
     */
    public function setEvaluationNote(\EchangeoBundle\Entity\Evaluation $evaluationNote = null)
    {
        $this->evaluationNote = $evaluationNote;

        return $this;
    }

    /**
     * Get evaluationNote
     *
     * @return \EchangeoBundle\Entity\Evaluation 
     */
    public function getEvaluationNote()
    {
        return $this->evaluationNote;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Service
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
}
