<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\ContactRepository")
 */
class Contact implements \Lthrt\EntityBundle\Entity\EntityLogging
{
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;
    use \Lthrt\EntityBundle\Entity\ValueTrait;

    /**
     * @var \Lthrt\ContactBundle\Entity\ContactType
     *
     * @ORM\ManyToOne(targetEntity="ContactType")
     */
    private $type;
}
