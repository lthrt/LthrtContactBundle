<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\AddressRepository")
 */
class Address implements \Lthrt\EntityBundle\Entity\EntityLog, \JsonSerializable
{
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;
    use \Lthrt\EntityBundle\Entity\JsonTrait;

    use \Lthrt\EntityBundle\Entity\ActiveTrait;

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
