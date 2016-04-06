<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * County.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\CountyRepository")
 */
class County
{
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;
    use \Lthrt\EntityBundle\Entity\NameTrait;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="City", inversedBy="county")
     * @ORM\JoinTable(name="county__city"))
     */
    private $city;

    /**
     * @var \Lthrt\ContactBundle\Entity\State
     *
     * @ORM\ManyToMany(targetEntity="State", inversedBy="county")
     * @ORM\JoinTable(name="county__state"))
     */
    private $state;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Zip", mappedBy="county")
     */
    private $zip;

    public function __construct()
    {
        $this->city  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->state = new \Doctrine\Common\Collections\ArrayCollection();
        $this->zip   = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
