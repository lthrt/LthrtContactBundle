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
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var \DateTime
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
        $this->contact = new \Doctrine\Common\Collections\ArrayCollection();
        $this->demographic = new \Doctrine\Common\Collections\ArrayCollection();
        $this->address = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Person
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get dob
     *
     * @return \DateTime 
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set dob
     *
     * @param \DateTime $dob
     * @return Person
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Add contact
     *
     * @param \Lthrt\ContactBundle\Entity\Contact $contact
     * @return Person
     */
    public function addContact(\Lthrt\ContactBundle\Entity\Contact $contact)
    {
        if ($this->contact->contains($contact)) {
        } else {
            $this->contact[] = $contact;
        }

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \Lthrt\ContactBundle\Entity\Contact $contact
     */
    public function removeContact(\Lthrt\ContactBundle\Entity\Contact $contact)
    {
        $this->contact->removeElement($contact);
    }

    /**
     * Get contact
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Add demographic
     *
     * @param \Lthrt\ContactBundle\Entity\Demographic $demographic
     * @return Person
     */
    public function addDemographic(\Lthrt\ContactBundle\Entity\Demographic $demographic)
    {
        if ($this->demographic->contains($demographic)) {
        } else {
            $this->demographic[] = $demographic;
        }

        return $this;
    }

    /**
     * Remove demographic
     *
     * @param \Lthrt\ContactBundle\Entity\Demographic $demographic
     */
    public function removeDemographic(\Lthrt\ContactBundle\Entity\Demographic $demographic)
    {
        $this->demographic->removeElement($demographic);
    }

    /**
     * Get demographic
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDemographic()
    {
        return $this->demographic;
    }

    /**
     * Add address
     *
     * @param \Lthrt\ContactBundle\Entity\Address $address
     * @return Person
     */
    public function addAddress(\Lthrt\ContactBundle\Entity\Address $address)
    {
        if ($this->address->contains($address)) {
        } else {
            $this->address[] = $address;
        }

        return $this;
    }

    /**
     * Remove address
     *
     * @param \Lthrt\ContactBundle\Entity\Address $address
     */
    public function removeAddress(\Lthrt\ContactBundle\Entity\Address $address)
    {
        $this->address->removeElement($address);
    }

    /**
     * Get address
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /** jsonSerialize
      *
      */
    public function JSONSerialize()
    {
        return [
            'class' => 'Lthrt_ContactBundle_Entity_Person',
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'dob' => $this->dob,
            'contact' => $this->contact->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_Contact','id' => $e->getId(),];})->toArray(),
            'demographic' => $this->demographic->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_Demographic','id' => $e->getId(),];})->toArray(),
            'address' => $this->address->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_Address','id' => $e->getId(),];})->toArray(),
        ];
    }

}
