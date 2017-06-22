<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AddressType.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\AddressTypeRepository")
 *
 * eg work, home
 */
class AddressType implements \Lthrt\EntityBundle\Entity\EntityLedger, \JsonSerializable
{
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;
    use \Lthrt\EntityBundle\Entity\JsonTrait;
    // use \Lthrt\EntityBundle\Entity\LoggingDisabledTrait;

    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\NameTrait;
}
