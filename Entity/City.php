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
    private $name;

    /**
     * @var \Lthrt\ContactBundle\Entity\State
     */
    private $state;



    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set state
     *
     * @param \Lthrt\ContactBundle\Entity\State $state
     * @return City
     */
    public function setState(\Lthrt\ContactBundle\Entity\State $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \Lthrt\ContactBundle\Entity\State 
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
            'class' => 'Lthrt_ContactBundle_Entity_City',
            'id' => $this->id,
            'name' => $this->name,
            'state' => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State','id'=>$this->state->id,]:'{}',
        ];
    }

}
