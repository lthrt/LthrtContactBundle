<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\UnloggedEntity;

/**
 * ContactType.
 */
class ContactType extends UnloggedEntity implements \JSONSerializable
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
     * @return ContactType
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
            'class' => 'Lthrt_ContactBundle_Entity_ContactType',
            'id'    => $this->id,
            'name'  => $this->name,
        ];
    }
}
