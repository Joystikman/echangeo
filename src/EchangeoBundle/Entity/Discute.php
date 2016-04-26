<?php

namespace EchangeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discute
 *
 * @ORM\Table(name="discute")
 * @ORM\Entity(repositoryClass="EchangeoBundle\Repository\DiscuteRepository")
 */
class Discute
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
