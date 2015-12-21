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
    private $name;
    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Set name
     *
     * @param string $name
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
        return [
            'class' => 'Lthrt_ContactBundle_Entity_AddressType',
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

}
