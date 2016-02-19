<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\AddressRepository")
 *
 */

class Address implements \JSONSerializable
{

    use \Lthrt\EntityJSONBundle\Entity\ActiveTrait;
    use \Lthrt\EntityJSONBundle\Entity\EntityTrait;
    use \Lthrt\EntityJSONBundle\Entity\LoggedTrait;

    /**
     * @var string
     */
    private $line;
    /**
     * @var string
     */
    private $line2;
    /**
     * @var string
     */
    private $zipExt;
    /**
     * @var \Lthrt\ContactBundle\Entity\AddressType
     */
    private $addressType;
    /**
     * @var \Lthrt\ContactBundle\Entity\City
     */
    private $city;
    /**
     * @var \Lthrt\ContactBundle\Entity\State
     */
    private $state;
    /**
     * @var \Lthrt\ContactBundle\Entity\Zip
     */
    private $zip;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $person;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->person = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
