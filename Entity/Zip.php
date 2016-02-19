<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zip
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\ZipRepository")
 *
 */

class Zip
{
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=5)
     */
    private $zip;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="City", inversedBy="zip")
     * @ORM\JoinTable(name="zip__city")
     */
    private $city;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="County", inversedBy="zip")
     * @ORM\JoinTable(name="zip__county")
     */
    private $county;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="State", inversedBy="zip")
     * @ORM\JoinTable(name="zip__state")
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
