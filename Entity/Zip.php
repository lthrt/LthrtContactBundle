<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zip
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\ZipRepository")
 *
 */

class Zip implements \JSONSerializable
{
    use \Lthrt\EntityJSONBundle\Entity\ActiveTrait;
    use \Lthrt\EntityJSONBundle\Entity\EntityTrait;

    /**
     * @var string
     */
    private $zip;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $city;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $county;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $state;

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'  => 'Lthrt_ContactBundle_Entity_Zip',
            'id'     => $this->id,
            'active' => $this->active,
            'zip'    => $this->zip,
            'city'   => ['class' => 'Lthrt_ContactBundle_Entity_City', 'id' => []],
            'county' => ['class' => 'Lthrt_ContactBundle_Entity_County', 'id' => []],
            'state'  => ['class' => 'Lthrt_ContactBundle_Entity_State', 'id' => []],
        ];

        if ($full) {
            $json = array_merge($json,
                [
                    'city'   => $this->city->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_City', 'id' => $e->getId()];})->toArray(),
                    'county' => $this->county->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_County', 'id' => $e->getId()];})->toArray(),
                    'state'  => $this->state->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_State', 'id' => $e->getId()];})->toArray(),
                ]
            );
        }

        return $json;
    }

}
