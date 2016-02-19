<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demographic
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\DemographicRepository")
 *
 */

class Demographic implements \JSONSerializable
{
    use \Lthrt\EntityJSONBundle\Entity\ActiveTrait;
    use \Lthrt\EntityJSONBundle\Entity\EntityTrait;
    use \Lthrt\EntityJSONBundle\Entity\LoggedTrait;

    /**
     * @var string
     */
    protected $value;
    /**
     * @var \Lthrt\ContactBundle\Entity\DemographicType
     */
    protected $demographicType;

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'           => 'Lthrt_ContactBundle_Entity_Demographic',
            'id'              => $this->id,
            'value'           => $this->value,
            'demographicType' => $this->demographicType ? ['class' => 'Lthrt_ContactBundle_Entity_DemographicType', 'id' => $this->demographicType->id] : '{}',
        ];

        if ($full) {
            $json = array_merge($json,
                [
                    'demographicType' => $this->demographicType ? ['class' => 'Lthrt_ContactBundle_Entity_DemographicType', 'id' => $this->demographicType->id] : '{}',
                ]
            );
        }

        return $json;
    }

}
