<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\AddressRepository")
 *
 */

class Address
{

    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;
    use \Lthrt\EntityBundle\Entity\LoggedTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="line", type="string", length=255)
     */
    private $line;

    /**
     * @var string
     *
     * @ORM\Column(name="line2", type="string", length=255)
     */
    private $line2;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_ext", type="string", length=4)
     */
    private $zipExt;

    /**
     * @var \Lthrt\ContactBundle\Entity\AddressType
     *
     * @ORM\ManyToOne(targetEntity="AddressType")
     */
    private $addressType;

    /**
     * @var \Lthrt\ContactBundle\Entity\City
     *
     * @ORM\ManyToOne(targetEntity="City")
     */
    private $city;

    /**
     * @var \Lthrt\ContactBundle\Entity\State
     *
     * @ORM\ManyToOne(targetEntity="State")
     */
    private $state;

    /**
     * @var \Lthrt\ContactBundle\Entity\Zip
     *
     * @ORM\ManyToOne(targetEntity="Zip")
     */
    private $zip;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Person", mappedBy="address")
     */
    private $person;

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'       => 'Lthrt_ContactBundle_Entity_Address',
            'id'          => $this->id,
            'active'      => $this->active,
            'line'        => $this->line,
            'line2'       => $this->line2,
            'zipExt'      => $this->zipExt,
            'addressType' => $this->addressType ? ['class' => 'Lthrt_ContactBundle_Entity_AddressType', 'id' => $this->addressType->id] : '{}',
            'city'        => $this->city ? ['class' => 'Lthrt_ContactBundle_Entity_City', 'id' => $this->city->id] : '{}',
            'state'       => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State', 'id' => $this->state->id] : '{}',
            'zip'         => $this->zip ? ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => $this->zip->id] : '{}',
            'person'      => ['class' => 'Lthrt_ContactBundle_Entity_Person', 'id' => []],
        ];

        if ($full) {
            $json = array_merge($json,
                [
                    'addressType' => $this->addressType ? ['class' => 'Lthrt_ContactBundle_Entity_AddressType', 'id' => $this->addressType->id] : '{}',
                    'city'        => $this->city ? ['class' => 'Lthrt_ContactBundle_Entity_City', 'id' => $this->city->id] : '{}',
                    'state'       => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State', 'id' => $this->state->id] : '{}',
                    'zip'         => $this->zip ? ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => $this->zip->id] : '{}',
                    'person'      => $this->person->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Person', 'id' => $e->getId()];})->toArray(),
                ]
            );
        }

        return $json;
    }

}
