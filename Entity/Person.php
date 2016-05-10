<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\PersonRepository")
 */
class Person implements \Lthrt\EntityBundle\Entity\EntityLogging
{
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="date")
     */
    private $dob;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Contact")
     * @ORM\JoinTable(name="person__contact")
     */
    private $contact;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Demographic")
     * @ORM\JoinTable(name="person__demographic")
     */
    private $demographic;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Address", inversedBy="person")
     * @ORM\JoinTable(name="person__address")
     */
    private $address;

    public function __construct()
    {
        $this->address     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contact     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->demographic = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
