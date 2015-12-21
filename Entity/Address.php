<?php
namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\LoggedEntity;

/**
 * Address.
 */
class Address extends LoggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    private $line;
    /**
     * @var string
     */
    private $line2;
    /**
     * @var string
     */
    private $zip;
    /**
     * @var \Lthrt\ContactBundle\Entity\AddressType
     */
    private $addressType;
    /**
     * @var \Lthrt\ContactBundle\Entity\City
     */
    private $city;
    /**
     * @var \Lthrt\ContactBundle\Entity\State
     */
    private $state;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $person;
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->person = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Get line.
     *
     * @return string
     */
    public function getLine()
    {
        return $this->line;
    }
    /**
     * Set line.
     *
     * @param string $line
     *
     * @return Address
     */
    public function setLine($line)
    {
        $this->line = $line;

        return $this;
    }
    /**
     * Get line2.
     *
     * @return string
     */
    public function getLine2()
    {
        return $this->line2;
    }
    /**
     * Set line2.
     *
     * @param string $line2
     *
     * @return Address
     */
    public function setLine2($line2)
    {
        $this->line2 = $line2;

        return $this;
    }
    /**
     * Get zip.
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }
    /**
     * Set zip.
     *
     * @param string $zip
     *
     * @return Address
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }
    /**
     * Set addressType.
     *
     * @param \Lthrt\ContactBundle\Entity\AddressType $addressType
     *
     * @return Address
     */
    public function setAddressType(\Lthrt\ContactBundle\Entity\AddressType $addressType = null)
    {
        $this->addressType = $addressType;

        return $this;
    }
    /**
     * Get addressType.
     *
     * @return \Lthrt\ContactBundle\Entity\AddressType
     */
    public function getAddressType()
    {
        return $this->addressType;
    }
    /**
     * Set city.
     *
     * @param \Lthrt\ContactBundle\Entity\City $city
     *
     * @return Address
     */
    public function setCity(\Lthrt\ContactBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }
    /**
     * Get city.
     *
     * @return \Lthrt\ContactBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }
    /**
     * Set state.
     *
     * @param \Lthrt\ContactBundle\Entity\State $state
     *
     * @return Address
     */
    public function setState(\Lthrt\ContactBundle\Entity\State $state = null)
    {
        $this->state = $state;

        return $this;
    }
    /**
     * Get state.
     *
     * @return \Lthrt\ContactBundle\Entity\State
     */
    public function getState()
    {
        return $this->state;
    }
    /**
     * Add person.
     *
     * @param \Lthrt\ContactBundle\Entity\Person $person
     *
     * @return Address
     */
    public function addPerson(\Lthrt\ContactBundle\Entity\Person $person)
    {
        if ($this->person->contains($person)) {
        } else {
            $this->person[] = $person;
        }

        return $this;
    }
    /**
     * Remove person.
     *
     * @param \Lthrt\ContactBundle\Entity\Person $person
     */
    public function removePerson(\Lthrt\ContactBundle\Entity\Person $person)
    {
        $this->person->removeElement($person);
    }
    /**
     * Get person.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPerson()
    {
        return $this->person;
    }

    /** jsonSerialize
     *
     */
    public function JSONSerialize()
    {
        return [
            'class'       => 'Lthrt_ContactBundle_Entity_Address',
            'id'          => $this->id,
            'line'        => $this->line,
            'line2'       => $this->line2,
            'zip'         => $this->zip,
            'addressType' => $this->addressType ? ['class'                     => 'Lthrt_ContactBundle_Entity_AddressType','id' => $this->addressType->id] : '{}',
            'city'        => $this->city ? ['class'                            => 'Lthrt_ContactBundle_Entity_City','id' => $this->city->id] : '{}',
            'state'       => $this->state ? ['class'                           => 'Lthrt_ContactBundle_Entity_State','id' => $this->state->id] : '{}',
            'person'      => $this->person->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Person', 'id' => $e->getId()];})->toArray(),
        ];
    }
}
