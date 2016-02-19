<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\ContactRepository")
 *
 */

class Contact implements \JSONSerializable
{
    use \Lthrt\EntityJSONBundle\Entity\ActiveTrait;
    use \Lthrt\EntityJSONBundle\Entity\EntityTrait;
    use \Lthrt\EntityJSONBundle\Entity\LoggedTrait;
    use \Lthrt\EntityJSONBundle\Entity\ValueTrait;

    /**
     * @var \Lthrt\ContactBundle\Entity\ContactType
     */
    private $contactType;

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'       => 'Lthrt_ContactBundle_Entity_Contact',
            'id'          => $this->id,
            'active'      => $this->active,
            'value'       => $this->value,
            'contactType' => $this->contactType ? ['class' => 'Lthrt_ContactBundle_Entity_ContactType', 'id' => $this->contactType->id] : '{}',
        ];

        if ($full) {
            $json = array_merge($json,
                [
                    'contactType' => $this->contactType ? ['class' => 'Lthrt_ContactBundle_Entity_ContactType', 'id' => $this->contactType->id] : '{}',
                ]
            );
        }

        return $json;
    }

}
