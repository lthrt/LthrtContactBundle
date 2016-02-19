<?php
namespace Lthrt\ContactBundle\Entity;
use Lthrt\EntityJSONBundle\Entity\UnloggedEntity;
/**
 * AddressType
 */
class AddressType extends UnloggedEntity implements \JSONSerializable
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

        return $json;
    }

}
