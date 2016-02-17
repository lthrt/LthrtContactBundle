<?php
namespace Lthrt\ContactBundle\Entity;
use Lthrt\EntityJSONBundle\Entity\LoggedEntity;
/**
 * Address
 */
class Address extends LoggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    protected $line;
    /**
     * @var string
     */
    protected $line2;
    /**
     * @var string
     */
    protected $zipExt;
    /**
     * @var \Lthrt\ContactBundle\Entity\AddressType
     */
    protected $addressType;
    /**
     * @var \Lthrt\ContactBundle\Entity\City
     */
    protected $city;
    /**
     * @var \Lthrt\ContactBundle\Entity\State
     */
    protected $state;
    /**
     * @var \Lthrt\ContactBundle\Entity\Zip
     */
    protected $zip;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $person;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->person = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * returns mappedBy field for property
     *
     * @return string
     */
    public function inversePerson()
    {
        return 'address';
    }


    /** jsonSerialize
      *
      */
    public function JSONSerialize($full = true)
    {
        $json = [
                    'class' => 'Lthrt_ContactBundle_Entity_Address',
                'id' => $this->id,
                'line' => $this->line,
                'line2' => $this->line2,
                'zipExt' => $this->zipExt,
                'addressType' => $this->addressType ? ['class' => 'Lthrt_ContactBundle_Entity_AddressType','id'=>$this->addressType->id,]:'{}',
                'city' => $this->city ? ['class' => 'Lthrt_ContactBundle_Entity_City','id'=>$this->city->id,]:'{}',
                'state' => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State','id'=>$this->state->id,]:'{}',
                'zip' => $this->zip ? ['class' => 'Lthrt_ContactBundle_Entity_Zip','id'=>$this->zip->id,]:'{}',
                'person' => ['class' => 'Lthrt_ContactBundle_Entity_Person','id'=>[]],
        ];

        if ($full) {
            $json = array_merge($json,
                [
                'addressType' => $this->addressType ? ['class' => 'Lthrt_ContactBundle_Entity_AddressType','id'=>$this->addressType->id,]:'{}',
                'city' => $this->city ? ['class' => 'Lthrt_ContactBundle_Entity_City','id'=>$this->city->id,]:'{}',
                'state' => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State','id'=>$this->state->id,]:'{}',
                'zip' => $this->zip ? ['class' => 'Lthrt_ContactBundle_Entity_Zip','id'=>$this->zip->id,]:'{}',
                'person' => $this->person->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_Person','id' => $e->getId(),];})->toArray(),
                ]
            );
        }

        return $json;
    }

}
