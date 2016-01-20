<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\UnloggedEntity;

/**
 * State
 */

class State extends UnloggedEntity implements \JSONSerializable
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
            'active' => $this->active,
            'city'   => $this->city->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_City','id' => $e->getId(),];})->toArray(),
            'county' => $this->county->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_County','id' => $e->getId(),];})->toArray(),
            'zip'    => $this->zip->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_Zip','id' => $e->getId(),];})->toArray(),
        ];
    }

}
