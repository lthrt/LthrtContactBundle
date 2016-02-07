<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\LoggedEntity;

/**
 * Contact.
 */
class Contact extends LoggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var \Lthrt\ContactBundle\Entity\ContactType
     */
    protected $contactType;

    /** jsonSerialize
     *
     */
    public function JSONSerialize()
    {
        return [
            'class'       => 'Lthrt_ContactBundle_Entity_Contact',
            'id'          => $this->id,
            'value'       => $this->value,
            'contactType' => $this->contactType ? ['class' => 'Lthrt_ContactBundle_Entity_ContactType','id' => $this->contactType->id] : '{}',
        ];
    }
}
