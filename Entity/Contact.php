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
    private $value;

    /**
     * @var \Lthrt\ContactBundle\Entity\ContactType
     */
    private $contactType;

    /**
     * Get value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value.
     *
     * @param string $value
     *
     * @return Contact
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Set contactType.
     *
     * @param \Lthrt\ContactBundle\Entity\ContactType $contactType
     *
     * @return Contact
     */
    public function setContactType(\Lthrt\ContactBundle\Entity\ContactType $contactType = null)
    {
        $this->contactType = $contactType;

        return $this;
    }

    /**
     * Get contactType.
     *
     * @return \Lthrt\ContactBundle\Entity\ContactType
     */
    public function getContactType()
    {
        return $this->contactType;
    }

    /** jsonSerialize
     *
     */
    public function JSONSerialize()
    {
        return [
            'class'       => 'Lthrt_ContactBundle_Entity_Contact',
            'id'          => $this->id,
            'value'       => $this->value,
            'contactType' => ['class' => 'Lthrt_ContactBundle_Entity_ContactType','id' => $this->contactType->id],
        ];
    }
}
