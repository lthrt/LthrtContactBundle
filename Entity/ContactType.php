<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactType
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\ContactTypeRepository")
 */

class ContactType implements \JSONSerializable
{
    use \Lthrt\EntityJSONBundle\Entity\EntityTrait;
    use \Lthrt\EntityJSONBundle\Entity\LoggedTrait;
    use \Lthrt\EntityJSONBundle\Entity\ActiveTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * JSONSerialize
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class' => 'Lthrt_ContactBundle_Entity_ContactType',
            'id'    => $this->id,
            'name'  => $this->name,
        ];

        return $json;
    }
}
