<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\UnloggedEntity;

/**
 * DemographicType
 */

class DemographicType extends UnloggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    private $name;



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
     * @return DemographicType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /** jsonSerialize
      *
      */
    public function JSONSerialize()
    {
        return [
            'class' => 'Lthrt_ContactBundle_Entity_DemographicType',
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

}
