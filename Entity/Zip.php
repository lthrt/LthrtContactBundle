<?php
namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\UnloggedEntity;

/**
 * Zip.
 */
class Zip extends UnloggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    private $zip;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $city;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $county;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $state;
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->city   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->county = new \Doctrine\Common\Collections\ArrayCollection();
        $this->state  = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }
    /**
     * Add city.
     *
     * @param \Lthrt\ContactBundle\Entity\City $city
     *
     * @return Zip
     */
    public function addCity(\Lthrt\ContactBundle\Entity\City $city)
    {
        if ($this->city->contains($city)) {
        } else {
            $this->city[] = $city;
        }

        return $this;
    }
    /**
     * Remove city.
     *
     * @param \Lthrt\ContactBundle\Entity\City $city
     */
    public function removeCity(\Lthrt\ContactBundle\Entity\City $city)
    {
        $this->city->removeElement($city);
    }
    /**
     * Get city.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCity()
    {
        return $this->city;
    }
    /**
     * Add county.
     *
     * @param \Lthrt\ContactBundle\Entity\County $county
     *
     * @return Zip
     */
    public function addCounty(\Lthrt\ContactBundle\Entity\County $county)
    {
        if ($this->county->contains($county)) {
        } else {
            $this->county[] = $county;
        }

        return $this;
    }
    /**
     * Remove county.
     *
     * @param \Lthrt\ContactBundle\Entity\County $county
     */
    public function removeCounty(\Lthrt\ContactBundle\Entity\County $county)
    {
        $this->county->removeElement($county);
    }
    /**
     * Get county.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCounty()
    {
        return $this->county;
    }
    /**
     * Add state.
     *
     * @param \Lthrt\ContactBundle\Entity\state $state
     *
     * @return Zip
     */
    public function addState(\Lthrt\ContactBundle\Entity\state $state)
    {
        if ($this->state->contains($state)) {
        } else {
            $this->state[] = $state;
        }

        return $this;
    }
    /**
     * Remove state.
     *
     * @param \Lthrt\ContactBundle\Entity\state $state
     */
    public function removeState(\Lthrt\ContactBundle\Entity\state $state)
    {
        $this->state->removeElement($state);
    }
    /**
     * Get state.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getState()
    {
        return $this->state;
    }

    /** jsonSerialize
     *
     */
    public function JSONSerialize()
    {
        return [
            'class' => 'Lthrt_ContactBundle_Entity_Zip',
            'id'    => $this->id,
            'zip'   => $this->zip,
            'city'  => $this->city->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_City', 'id' => $e->getId()];})->toArray(),
            'county'                                                   => $this->county->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_County', 'id' => $e->getId()];})->toArray(),
            'state'                                                                                                         => $this->state->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_state', 'id' => $e->getId()];})->toArray(),
        ];
    }
}
