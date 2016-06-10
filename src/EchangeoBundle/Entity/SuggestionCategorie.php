<?php

namespace EchangeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SuggestionCategorie
 *
 * @ORM\Table(name="suggestion_categorie")
 * @ORM\Entity(repositoryClass="EchangeoBundle\Repository\SuggestionCategorieRepository")
 */
class SuggestionCategorie
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
     * @ORM\Column(name="libelle", type="string", length=255, unique=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Inscrit", inversedBy="suggestions")
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
     * Set libelle
     *
     * @param string $libelle
     * @return SuggestionCategorie
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return SuggestionCategorie
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
     * Set inscrit
     *
     * @param \EchangeoBundle\Entity\Inscrit $inscrit
     * @return SuggestionCategorie
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
}
