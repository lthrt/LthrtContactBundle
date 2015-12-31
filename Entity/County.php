<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\UnloggedEntity;

/**
 * County.
 */
class County extends UnloggedEntity implements \JSONSerializable
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
    private $city;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $zip;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->city = new \Doctrine\Common\Collections\ArrayCollection();
        $this->zip  = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return County
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
     * @return County
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
     * Add city.
     *
     * @param \Lthrt\ContactBundle\Entity\City $city
     *
     * @return County
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
     * Add zip.
     *
     * @param \Lthrt\ContactBundle\Entity\Zip $zip
     *
     * @return County
     */
    public function addZip(\Lthrt\ContactBundle\Entity\Zip $zip)
    {
        if ($this->zip->contains($zip)) {
        } else {
            $this->zip[] = $zip;
        }

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

    /** jsonSerialize
     *
     */
    public function JSONSerialize()
    {
        return [
            'class' => 'Lthrt_ContactBundle_Entity_County',
            'id'    => $this->id,
            'name'  => $this->name,
            'state' => $this->state ? ['class'                         => 'Lthrt_ContactBundle_Entity_State','id' => $this->state->id] : '{}',
            'city'  => $this->city->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_City', 'id' => $e->getId()];})->toArray(),
            'zip'                                                      => $this->zip->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => $e->getId()];})->toArray(),
        ];
    }
}
