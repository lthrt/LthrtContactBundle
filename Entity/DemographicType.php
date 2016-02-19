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

class DemographicType
{
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;
    use \Lthrt\EntityBundle\Entity\NameTrait;

    /**
     * JSONSerialize
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'  => 'Lthrt_ContactBundle_Entity_DemographicType',
            'id'     => $this->id,
            'active' => $this->active,
            'name'   => $this->name,
        ];

        return $json;
    }
}
