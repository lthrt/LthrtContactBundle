<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\LoggedEntity;

/**
 * State
 */

class State extends LoggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    protected $abbr;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $city;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $county;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $zip;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->city   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->county = new \Doctrine\Common\Collections\ArrayCollection();
        $this->zip    = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * returns mappedBy field for property
     * this allows generic model to set owningside
     * in generic method in AbstractEntity
     *
     * @return string
     */
    public function inverseCity()
    {

        return 'state';
    }

    /**
     * returns mappedBy field for property
     * this allows generic model to set owningside
     * in generic method in AbstractEntity
     *
     * @return string
     */
    public function inverseCounty()
    {

        return 'state';
    }

    /**
     * returns mappedBy field for property
     * this allows generic model to set owningside
     * in generic method in AbstractEntity
     *
     * @return string
     */
    public function inverseZip()
    {

        return 'state';
    }

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'  => 'Lthrt_ContactBundle_Entity_State',
            'id'     => $this->id,
            'abbr'   => $this->abbr,
            'name'   => $this->name,
            'city'   => ['class' => 'Lthrt_ContactBundle_Entity_City', 'id' => []],
            'county' => ['class' => 'Lthrt_ContactBundle_Entity_County', 'id' => []],
            'zip'    => ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => []],
        ];

        if ($full) {
            $json = array_merge($json,
                [
                    'city'   => $this->city->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_City', 'id' => $e->getId()];})->toArray(),
                    'county' => $this->county->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_County', 'id' => $e->getId()];})->toArray(),
                    'zip'    => $this->zip->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => $e->getId()];})->toArray(),
                ]
            );
        }

        return $json;
    }

}
