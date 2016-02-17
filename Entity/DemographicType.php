<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\LoggedEntity;

/**
 * DemographicType
 */

class DemographicType extends LoggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    protected $name;



    /** jsonSerialize
      *
      */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class' => 'Lthrt_ContactBundle_Entity_DemographicType',
                'id' => $this->id,
                'name' => $this->name,
        ];

        return $json;
    }

}
