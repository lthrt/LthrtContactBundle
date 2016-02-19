<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demographic
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\DemographicRepository")
 *
 */

class Demographic
{
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;
    use \Lthrt\EntityBundle\Entity\LoggedTrait;
    use \Lthrt\EntityBundle\Entity\ValueTrait;

    /**
     * @var \Lthrt\ContactBundle\Entity\DemographicType
     *
     * @ORM\ManyToOne(targetEntity="DemographicType")
     */
    private $demographicType;

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'           => 'Lthrt_ContactBundle_Entity_Demographic',
            'id'              => $this->id,
            'active'          => $this->active,
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
