<?php

namespace EchangeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="EchangeoBundle\Repository\CategorieRepository")
 */
class Categorie
{


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="EchangeoBundle\Entity\SousCategorie")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
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
     * @ORM\OneToMany(targetEntity="SousCategorie", mappedBy="categorie", cascade={"remove", "persist"})
     */
    private $sousCategories;


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
     * @return Categorie
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
     * @return Categorie
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
     * Constructor
     */
    public function __construct()
    {
        $this->sousCategories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sousCategories
     *
     * @param \EchangeoBundle\Entity\SousCategorie $sousCategories
     * @return Categorie
     */
    public function addSousCategory(\EchangeoBundle\Entity\SousCategorie $sousCategories)
    {
        $this->sousCategories[] = $sousCategories;

        return $this;
    }

    /**
     * Remove sousCategories
     *
     * @param \EchangeoBundle\Entity\SousCategorie $sousCategories
     */
    public function removeSousCategory(\EchangeoBundle\Entity\SousCategorie $sousCategories)
    {
        $this->sousCategories->removeElement($sousCategories);
    }

    /**
     * Get sousCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSousCategories()
    {
        return $this->sousCategories;
    }
}
