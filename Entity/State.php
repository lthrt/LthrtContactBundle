<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * State
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\StateRepository")
 *
 */

class State
{
    use \Lthrt\EntityBundle\Entity\AbbrTrait;
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;
    use \Lthrt\EntityBundle\Entity\NameTrait;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="City", mappedBy="state")
     */
    private $city;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="County", mappedBy="state")
     */
    private $county;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Zip", mappedBy="state")
     */
    private $zip;

    public function __construct()
    {
        $this->city   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->county = new \Doctrine\Common\Collections\ArrayCollection();
        $this->zip    = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
