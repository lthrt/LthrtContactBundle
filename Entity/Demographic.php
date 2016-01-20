<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\LoggedEntity;

/**
 * Demographic.
 */
class Demographic extends LoggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var \Lthrt\ContactBundle\Entity\DemographicType
     */
    protected $demographicType;

    /** jsonSerialize
     *
     */
    public function JSONSerialize()
    {
        return [
            'class'           => 'Lthrt_ContactBundle_Entity_Demographic',
            'id'              => $this->id,
            'value'           => $this->value,
            'demographicType' => $this->demographicType ? ['class' => 'Lthrt_ContactBundle_Entity_DemographicType','id' => $this->demographicType->id] : '{}',
        ];
    }
}
