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
     *
     * @ORM\ManyToOne(targetEntity="Categorie", cascade={"remove"})
     * @ORM\JoinColumn(name="Categorie_id", referencedColumnName="id")
     */
    private $Categorie;


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
     * Set Categorie
     *
     * @param \EchangeoBundle\Entity\Categorie $categorie
     * @return SousCategorie
     */
    public function setCategorie(\EchangeoBundle\Entity\Categorie $categorie = null)
    {
        $this->Categorie = $categorie;

        return $this;
    }

    /**
     * Get Categorie
     *
     * @return \EchangeoBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->Categorie;
    }
}
