<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\LoggedEntity;

/**
 * AddressType
 */

class AddressType extends LoggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    protected $name;



    /** jsonSerialize
      *
      */
    public function JSONSerialize()
    {
        return [
            'class' => 'Lthrt_ContactBundle_Entity_AddressType',
            'id'    => $this->id,
            'name'  => $this->name,
        ];
    }

}
