<?php
namespace Lthrt\ContactBundle\Entity;
use Lthrt\EntityJSONBundle\Entity\UnloggedEntity;
/**
 * ContactType
 */
class ContactType extends UnloggedEntity implements \JSONSerializable
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
            'class' => 'Lthrt_ContactBundle_Entity_ContactType',
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

}
