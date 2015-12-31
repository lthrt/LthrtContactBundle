<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\UnloggedEntity;

/**
 * City.
 */
class City extends UnloggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var \Lthrt\ContactBundle\Entity\State
     */
    private $state;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $zip;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $county;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->zip    = new \Doctrine\Common\Collections\ArrayCollection();
        $this->county = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set state.
     *
     * @param \Lthrt\ContactBundle\Entity\State $state
     *
     * @return City
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
     * Add zip.
     *
     * @param \Lthrt\ContactBundle\Entity\Zip $zip
     *
     * @return City
     */
    public function addZip(\Lthrt\ContactBundle\Entity\Zip $zip)
    {
        if ($this->zip->contains($zip)) {
        } else {
            $this->zip[] = $zip;
        }
        $zip->addCity($this);


        return $this;
    }

    /**
     * Remove zip.
     *
     * @param \Lthrt\ContactBundle\Entity\Zip $zip
     */
    public function removeZip(\Lthrt\ContactBundle\Entity\Zip $zip)
    {
        $this->zip->removeElement($zip);
    }

    /**
     * Get zip.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Add county.
     *
     * @param \Lthrt\ContactBundle\Entity\County $county
     *
     * @return City
     */
    public function addCounty(\Lthrt\ContactBundle\Entity\County $county)
    {
        if ($this->county->contains($county)) {
        } else {
            $this->county[] = $county;
        }

        $county->addCity($this);

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

    /** jsonSerialize
     *
     */
    public function JSONSerialize()
    {
        return [
            'class' => 'Lthrt_ContactBundle_Entity_City',
            'id'    => $this->id,
            'name'  => $this->name,
            'state' => $this->state ? ['class'                        => 'Lthrt_ContactBundle_Entity_State','id' => $this->state->id] : '{}',
            'zip'   => $this->zip->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => $e->getId()];})->toArray(),
            'county'                                                  => $this->county->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_County', 'id' => $e->getId()];})->toArray(),
        ];
    }
}
