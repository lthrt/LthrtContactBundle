<?php
namespace Lthrt\ContactBundle\Entity;
use Lthrt\EntityJSONBundle\Entity\UnloggedEntity;
/**
 * County
 */
class County extends UnloggedEntity implements \JSONSerializable
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var \Lthrt\ContactBundle\Entity\State
     */
    protected $state;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $city;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $zip;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->city = new \Doctrine\Common\Collections\ArrayCollection();
        $this->zip = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /** jsonSerialize
      *
      */
    public function JSONSerialize($full = true)
    {
        $json = [
                    'class' => 'Lthrt_ContactBundle_Entity_County',
                'id' => $this->id,
                'name' => $this->name,
                'state' => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State','id'=>$this->state->id,]:'{}',
                'city' => ['class' => 'Lthrt_ContactBundle_Entity_City','id'=>[]],
                'zip' => ['class' => 'Lthrt_ContactBundle_Entity_Zip','id'=>[]],
        ];

        if ($full) {
            $json = array_merge($json,
                [
                'state' => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State','id'=>$this->state->id,]:'{}',
                'city' => $this->city->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_City','id' => $e->getId(),];})->toArray(),
                'zip' => $this->zip->map(function($e){return ['class' => 'Lthrt_ContactBundle_Entity_Zip','id' => $e->getId(),];})->toArray(),
                ]
            );
        }

        return $json;
    }

}
