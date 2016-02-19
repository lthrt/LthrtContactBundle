<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\CityRepository")
 *
 */

class City implements \JSONSerializable
{
    use \Lthrt\EntityJSONBundle\Entity\ActiveTrait;
    use \Lthrt\EntityJSONBundle\Entity\EntityTrait;
    use \Lthrt\EntityJSONBundle\Entity\NameTrait;

    /**
     * @var \Lthrt\ContactBundle\Entity\State
     */
    private $state;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $zip;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $county;
    /**
     * Constructor
     */

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'  => 'Lthrt_ContactBundle_Entity_City',
            'id'     => $this->id,
            'active' => $this->active,
            'name'   => $this->name,
            'state'  => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State', 'id' => $this->state->id] : '{}',
            'zip'    => ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => []],
            'county' => ['class' => 'Lthrt_ContactBundle_Entity_County', 'id' => []],
        ];

        if ($full) {
            $json = array_merge($json,
                [
                    'state'  => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State', 'id' => $this->state->id] : '{}',
                    'zip'    => $this->zip->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => $e->getId()];})->toArray(),
                    'county' => $this->county->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_County', 'id' => $e->getId()];})->toArray(),
                ]
            );
        }

        return $json;
    }

}
