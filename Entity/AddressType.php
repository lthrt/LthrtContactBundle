<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AddressType
 * @ORM\Table()
 * @ORM\Entity
 */

class AddressType implements \JSONSerializable
{
    use \Lthrt\EntityJSONBundle\Entity\EntityTrait;
    use \Lthrt\EntityJSONBundle\Entity\LoggedTrait;
    use \Lthrt\EntityJSONBundle\Entity\ActiveTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class' => 'Lthrt_ContactBundle_Entity_AddressType',
            'id'    => $this->id,
            'name'  => $this->name,
        ];

        return $json;
    }

}
