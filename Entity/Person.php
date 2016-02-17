<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\LoggedEntity;

/**
 * Person
 */

class Person extends LoggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var date
     */
    protected $dob;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $contact;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $demographic;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $address;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contact = new \Doctrine\Common\Collections\ArrayCollection();
        $this->demographic = new \Doctrine\Common\Collections\ArrayCollection();
        $this->address = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /** jsonSerialize
      *
      */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class' => 'Lthrt_ContactBundle_Entity_Person',
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'dob' => $this->dob,
            'contact' => null,
            'demographic' => null,
            'address' => null,
        ];

        if ($full) {
            $json = array_merge($json,
                [
            'contact' => $this->contact->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_Contact','id' => $e->getId(),];})->toArray(),
            'demographic' => $this->demographic->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_Demographic','id' => $e->getId(),];})->toArray(),
            'address' => $this->address->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_Address','id' => $e->getId(),];})->toArray(),
                ]
            );
        }

        return $json;
    }

}
