<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\UnloggedEntity;

/**
 * City
 */

class City extends UnloggedEntity implements \JSONSerializable
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


    /** jsonSerialize
      *
      */
    public function JSONSerialize()
    {
        return [
            'class'  => 'Lthrt_ContactBundle_Entity_City',
            'id'     => $this->id,
            'name'   => $this->name,
            'state'  => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State','id'=>$this->state->id,]:'{}',
            'zip'    => $this->zip->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_Zip','id' => $e->getId(),];})->toArray(),
            'county' => $this->county->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_County','id' => $e->getId(),];})->toArray(),
        ];
    }

}
