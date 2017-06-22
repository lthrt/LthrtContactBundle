<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lthrt\EntityBundle\Annotation\NoLog;

/**
 * Person.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\PersonRepository")
 */
class Person implements \Lthrt\EntityBundle\Entity\EntityLog, \JsonSerializable
{
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;
    use \Lthrt\EntityBundle\Entity\JsonTrait;

    use \Lthrt\EntityBundle\Entity\ActiveTrait;

    /**
     * @var string
     *
     * @Lthrt\EntityBundle\Annotation\NoLog(active=true)
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @Lthrt\EntityBundle\Annotation\NoLog(active=true)
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
