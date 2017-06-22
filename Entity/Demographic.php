<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demographic.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\DemographicRepository")
 */
class Demographic implements \Lthrt\EntityBundle\Entity\EntityLedger, \JsonSerializable
{
    use \Lthrt\EntityBundle\Entity\DoctrineEntityTrait;
    use \Lthrt\EntityBundle\Entity\JsonTrait;

    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\ValueTrait;

    /**
     * @var \Lthrt\ContactBundle\Entity\DemographicType
     *
     * @ORM\ManyToOne(targetEntity="DemographicType")
     */
    private $type;
}
