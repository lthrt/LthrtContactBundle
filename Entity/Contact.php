<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\ContactRepository")
 *
 */

class Contact
{
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;
    use \Lthrt\EntityBundle\Entity\LoggedTrait;
    use \Lthrt\EntityBundle\Entity\ValueTrait;

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
