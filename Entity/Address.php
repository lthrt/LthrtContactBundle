<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\AddressRepository")
 */
class Address implements \Lthrt\EntityBundle\Entity\EntityLogging;

{
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="line", type="string", length=255)
     */
    private $line;

    /**
     * @var string
     *
     * @ORM\Column(name="line2", type="string", length=255)
     */
    private $line2;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_ext", type="string", length=4)
     */
    private $zipExt;

    /**
     * @var \Lthrt\ContactBundle\Entity\AddressType
     *
     * @ORM\ManyToOne(targetEntity="AddressType")
     */
    private $type;

    /**
     * @var \Lthrt\ContactBundle\Entity\City
     *
     * @ORM\ManyToOne(targetEntity="City")
     */
    private $city;

    /**
     * @var \Lthrt\ContactBundle\Entity\State
     *
     * @ORM\ManyToOne(targetEntity="State")
     */
    private $state;

    /**
     * @var \Lthrt\ContactBundle\Entity\Zip
     *
     * @ORM\ManyToOne(targetEntity="Zip")
     */
    private $zip;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Person", mappedBy="address")
     */
    private $person;

    public function __construct()
    {
        $this->person = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
