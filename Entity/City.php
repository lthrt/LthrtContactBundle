<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\LoggedEntity;

/**
 * City
 */

class City extends LoggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var \Lthrt\ContactBundle\Entity\State
     */
    protected $state;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $zip;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $county;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->zip    = new \Doctrine\Common\Collections\ArrayCollection();
        $this->county = new \Doctrine\Common\Collections\ArrayCollection();
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

        return 'city';
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

        return 'city';
    }

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'  => 'Lthrt_ContactBundle_Entity_City',
            'id'     => $this->id,
            'name'   => $this->name,
            'state'  => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State', 'id' => $this->state->id] : '{}',
            'zip'    => ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => []],
            'county' => ['class' => 'Lthrt_ContactBundle_Entity_County', 'id' => []],
        ];

        if ($full) {
            $json = array_merge($json,
                [
                    'state'  => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State', 'id' => $this->state->id] : '{}',
                    'zip'    => $this->zip->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => $e->getId()];})->toArray(),
                    'county' => $this->county->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_County', 'id' => $e->getId()];})->toArray(),
                ]
            );
        }

        return $json;
    }

}
