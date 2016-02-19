<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * County
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\CountyRepository")
 *
 */

class County implements \JSONSerializable
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
    private $city;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $zip;

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'  => 'Lthrt_ContactBundle_Entity_County',
            'id'     => $this->id,
            'active' => $this->active,
            'name'   => $this->name,
            'state'  => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State', 'id' => $this->state->id] : '{}',
            'city'   => ['class' => 'Lthrt_ContactBundle_Entity_City', 'id' => []],
            'zip'    => ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => []],
        ];

        if ($full) {
            $json = array_merge($json,
                [
                    'state' => $this->state ? ['class' => 'Lthrt_ContactBundle_Entity_State', 'id' => $this->state->id] : '{}',
                    'city'  => $this->city->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_City', 'id' => $e->getId()];})->toArray(),
                    'zip'   => $this->zip->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => $e->getId()];})->toArray(),
                ]
            );
        }

        return $json;
    }

}
