<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\CityRepository")
 *
 */

class City
{
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;
    use \Lthrt\EntityBundle\Entity\NameTrait;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="County", mappedBy="city")
     */
    private $county;

    /**
     * @var \Lthrt\ContactBundle\Entity\State
     *
     * @ORM\ManyToOne(targetEntity="State", inversedBy="city")
     */
    private $state;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Zip", mappedBy="city")
     */
    private $zip;

    public function __construct()
    {
        $this->county = new \Doctrine\Common\Collections\ArrayCollection();
        $this->zip    = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
