<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactType.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\ContactTypeRepository")
 *
 * eg email, work phone
 */
class ContactType
{
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;
    use \Lthrt\EntityBundle\Entity\NameTrait;
}
