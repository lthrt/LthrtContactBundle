<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemographicType
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\DemographicTypeRepository")
 *
 * eg gender, race, ethnicity
 *
 */

class DemographicType implements \JSONSerializable
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
            'class' => 'Lthrt_ContactBundle_Entity_DemographicType',
            'id'    => $this->id,
            'name'  => $this->name,
        ];

        return $json;
    }
}
