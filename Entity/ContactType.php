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
class ContactType implements \Lthrt\EntityBundle\Entity\EntityLedger, \JsonSerializable
{
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;
    use \Lthrt\EntityBundle\Entity\JsonTrait;
    // use \Lthrt\EntityBundle\Entity\LoggingDisabledTrait;

    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\NameTrait;
}
