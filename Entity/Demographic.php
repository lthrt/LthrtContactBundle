<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// * @ORM\Table()

/**
 * Demographic.
 *
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="single_type_of_demo", columns={"type_id", "value"})})
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
     * @ORM\ManyToOne(targetEntity="DemographicType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;
}
