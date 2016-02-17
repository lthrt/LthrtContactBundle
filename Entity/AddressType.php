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
    public function JSONSerialize($full = true)
    {
        $json = [
            'class' => 'Lthrt_ContactBundle_Entity_AddressType',
            'id' => $this->id,
            'name' => $this->name,
        ];

        if ($full) {
            $json = array_merge($json,
                [

                ]
            );
        }

        return $json;
    }

}
