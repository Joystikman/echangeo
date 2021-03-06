<?php

namespace EchangeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousCategorie
 *
 * @ORM\Table(name="sous_categorie")
 * @ORM\Entity(repositoryClass="EchangeoBundle\Repository\SousCategorieRepository")
 */
class SousCategorie
{
    /**
    * @ORM\ManyToOne(targetEntity="EchangeoBundle\Entity\Categorie")
    * @ORM\JoinColumn(name="Categorie_id", referencedColumnName="id")
    */
    
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
     * @var string
     *
     * @ORM\Column(name="icone", type="string", length=255, nullable=true)
     */
    private $icone;


    /**
     *
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="sousCategories")
     * @ORM\JoinColumn(name="Categorie_id", referencedColumnName="id")
     */
    private $categorie;

    /**
     *
     * @ORM\OneToMany(targetEntity="Service", mappedBy="sousCategorie")
     */
    private $services;


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
     * @return SousCategorie
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
     * @return SousCategorie
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
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set categorie
     *
     * @param \EchangeoBundle\Entity\Categorie $categorie
     * @return SousCategorie
     */
    public function setCategorie(\EchangeoBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \EchangeoBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Add services
     *
     * @param \EchangeoBundle\Entity\Service $services
     * @return SousCategorie
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
     * Set icone
     *
     * @param string $icone
     *
     * @return SousCategorie
     */
    public function setIcone($icone)
    {
        $this->icone = $icone;

        return $this;
    }

    /**
     * Get icone
     *
     * @return string
     */
    public function getIcone()
    {
        return $this->icone;
    }
}
