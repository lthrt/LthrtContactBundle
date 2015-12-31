<?php

namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\UnloggedEntity;

/**
 * Demographic.
 */
class Demographic extends UnloggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var \Lthrt\ContactBundle\Entity\DemographicType
     */
    private $demographicType;

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
     * @return Demographic
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Set demographicType.
     *
     * @param \Lthrt\ContactBundle\Entity\DemographicType $demographicType
     *
     * @return Demographic
     */
    public function setDemographicType(\Lthrt\ContactBundle\Entity\DemographicType $demographicType = null)
    {
        $this->demographicType = $demographicType;

        return $this;
    }

    /**
     * Get demographicType.
     *
     * @return \Lthrt\ContactBundle\Entity\DemographicType
     */
    public function getDemographicType()
    {
        return $this->demographicType;
    }

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
