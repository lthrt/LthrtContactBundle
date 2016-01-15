<?php
namespace Lthrt\ContactBundle\Entity;
use Lthrt\EntityJSONBundle\Entity\UnloggedEntity;
/**
 * State.
 */
class State extends UnloggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    private $abbr;
    /**
     * @var string
     */
    private $name;
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
    private $zip;

    /**
     * @var boolean
     */
    private $active;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->city   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->county = new \Doctrine\Common\Collections\ArrayCollection();
        $this->zip    = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Get abbr.
     *
     * @return string
     */
    public function getAbbr()
    {
        return $this->abbr;
    }
    /**
     * Set abbr.
     *
     * @param string $abbr
     *
     * @return State
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;
        return $this;
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
     * @return State
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Add city.
     *
     * @param \Lthrt\ContactBundle\Entity\City $city
     *
     * @return State
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
     * @return State
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
     * Add zip.
     *
     * @param \Lthrt\ContactBundle\Entity\Zip $zip
     *
     * @return State
     */
    public function addZip(\Lthrt\ContactBundle\Entity\Zip $zip)
    {
        if ($this->zip->contains($zip)) {
        } else {
            $this->zip[] = $zip;
        }
        $zip->addState($this);
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
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return State
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /** jsonSerialize
      *
      */
    public function JSONSerialize()
    {
        return [
            'class' => 'Lthrt_ContactBundle_Entity_State',
            'id' => $this->id,
            'abbr' => $this->abbr,
            'name' => $this->name,
            'active' => $this->active,
            'city' => $this->city->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_City','id' => $e->getId(),];})->toArray(),
            'county' => $this->county->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_County','id' => $e->getId(),];})->toArray(),
            'zip' => $this->zip->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_Zip','id' => $e->getId(),];})->toArray(),
        ];
    }

}
