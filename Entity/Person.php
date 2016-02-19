<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\PersonRepository")
 *
 */

class Person implements \JSONSerializable
{
    use \Lthrt\EntityJSONBundle\Entity\ActiveTrait;
    use \Lthrt\EntityJSONBundle\Entity\EntityTrait;
    use \Lthrt\EntityJSONBundle\Entity\LoggedTrait;

    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var date
     */
    private $dob;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contact;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $demographic;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $address;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contact     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->demographic = new \Doctrine\Common\Collections\ArrayCollection();
        $this->address     = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'       => 'Lthrt_ContactBundle_Entity_Person',
            'id'          => $this->id,
            'active'      => $this->active,
            'firstName'   => $this->firstName,
            'lastName'    => $this->lastName,
            'dob'         => $this->dob,
            'contact'     => ['class' => 'Lthrt_ContactBundle_Entity_Contact', 'id' => []],
            'demographic' => ['class' => 'Lthrt_ContactBundle_Entity_Demographic', 'id' => []],
            'address'     => ['class' => 'Lthrt_ContactBundle_Entity_Address', 'id' => []],
        ];

        if ($full) {
            $json = array_merge($json,
                [
                    'contact'     => $this->contact->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Contact', 'id' => $e->getId()];})->toArray(),
                    'demographic' => $this->demographic->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Demographic', 'id' => $e->getId()];})->toArray(),
                    'address'     => $this->address->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Address', 'id' => $e->getId()];})->toArray(),
                ]
            );
        }

        return $json;
    }

}
