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
    private $county;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $zip;

    /**
     * Constructor.
     */
    public function __construct()
    {
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
            'class'  => 'Lthrt_ContactBundle_Entity_State',
            'id'     => $this->id,
            'abbr'   => $this->abbr,
            'name'   => $this->name,
            'county' => $this->county->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_County', 'id' => $e->getId()];})->toArray(),
            'zip'                                                         => $this->zip->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => $e->getId()];})->toArray(),
        ];
    }
}
