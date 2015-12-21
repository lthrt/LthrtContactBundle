<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\LoggedEntity;

/**
 * AddressType.
 */
class AddressType extends LoggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    private $name;

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return AddressType
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
        return array_merge(parent::JSONSerialize(),
            [
                'class' => 'Lthrt_ContactBundle_Entity_AddressType',
                'id'    => $this->id,
                'name'  => $this->name,
            ]
        );
    }
}
