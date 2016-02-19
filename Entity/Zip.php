<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zip
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\ZipRepository")
 *
 */

class Zip
{
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=5)
     */
    private $zip;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="City", inversedBy="zip")
     * @ORM\JoinTable(name="zip__city")
     */
    private $city;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="County", inversedBy="zip")
     * @ORM\JoinTable(name="zip__county")
     */
    private $county;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="State", inversedBy="zip")
     * @ORM\JoinTable(name="zip__state")
     */
    private $state;

    public function __construct()
    {
        $this->city   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->county = new \Doctrine\Common\Collections\ArrayCollection();
        $this->state  = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
