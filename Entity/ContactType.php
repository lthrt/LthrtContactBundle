<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\LoggedEntity;

/**
 * ContactType
 */

class ContactType extends LoggedEntity implements \JSONSerializable
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
            'class' => 'Lthrt_ContactBundle_Entity_ContactType',
                'id' => $this->id,
                'name' => $this->name,
        ];

        return $json;
    }

}
