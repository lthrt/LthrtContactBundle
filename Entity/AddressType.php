<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AddressType
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\AddressTypeRepository")
 *
 * eg work, home
 *
 */

class AddressType
{
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;
    use \Lthrt\EntityBundle\Entity\NameTrait;

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'  => 'Lthrt_ContactBundle_Entity_AddressType',
            'id'     => $this->id,
            'active' => $this->active,
            'name'   => $this->name,
        ];

        return $json;
    }

}
