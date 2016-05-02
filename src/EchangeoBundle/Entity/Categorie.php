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
    private $sousCategorie;


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
        $this->sousCategorie = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sousCategorie
     *
     * @param \EchangeoBundle\Entity\SousCategorie $sousCategorie
     * @return Categorie
     */
    public function addSousCategorie(\EchangeoBundle\Entity\SousCategorie $sousCategorie)
    {
        $this->sousCategorie[] = $sousCategorie;

        return $this;
    }

    /**
     * Remove sousCategorie
     *
     * @param \EchangeoBundle\Entity\SousCategorie $sousCategorie
     */
    public function removeSousCategorie(\EchangeoBundle\Entity\SousCategorie $sousCategorie)
    {
        $this->sousCategorie->removeElement($sousCategorie);
    }

    /**
     * Get sousCategorie
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSousCategorie()
    {
        return $this->sousCategorie;
    }
}
