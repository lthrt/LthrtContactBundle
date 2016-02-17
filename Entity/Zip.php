<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\LoggedEntity;

/**
 * Zip
 */

class Zip extends LoggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    protected $zip;

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
    protected $state;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->city = new \Doctrine\Common\Collections\ArrayCollection();
        $this->county = new \Doctrine\Common\Collections\ArrayCollection();
        $this->state = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /** jsonSerialize
      *
      */
    public function JSONSerialize($full = true)
    {
        $json = [
                    'class' => 'Lthrt_ContactBundle_Entity_Zip',
                'id' => $this->id,
                'zip' => $this->zip,
                'city' => ['class' => 'Lthrt_ContactBundle_Entity_City','id'=>[]],
                'county' => ['class' => 'Lthrt_ContactBundle_Entity_County','id'=>[]],
                'state' => ['class' => 'Lthrt_ContactBundle_Entity_State','id'=>[]],
        ];

        if ($full) {
            $json = array_merge($json,
                [
                'city' => $this->city->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_City','id' => $e->getId(),];})->toArray(),
                'county' => $this->county->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_County','id' => $e->getId(),];})->toArray(),
                'state' => $this->state->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_State','id' => $e->getId(),];})->toArray(),
                ]
            );
        }

        return $json;
    }

}
