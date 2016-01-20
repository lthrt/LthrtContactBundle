<?php
namespace Lthrt\ContactBundle\Entity;

use Lthrt\EntityJSONBundle\Entity\UnloggedEntity;

/**
 * DemographicType.
 */
class DemographicType extends UnloggedEntity implements \JSONSerializable
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
            'class' => 'Lthrt_ContactBundle_Entity_DemographicType',
            'id'    => $this->id,
            'name'  => $this->name,
        ];
    }
}
