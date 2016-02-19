<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * State
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\StateRepository")
 *
 */

class State
{
    use \Lthrt\EntityBundle\Entity\AbbrTrait;
    use \Lthrt\EntityBundle\Entity\ActiveTrait;
    use \Lthrt\EntityBundle\Entity\EntityTrait;
    use \Lthrt\EntityBundle\Entity\NameTrait;

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
    private $zip;

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'  => 'Lthrt_ContactBundle_Entity_State',
            'id'     => $this->id,
            'active' => $this->active,
            'abbr'   => $this->abbr,
            'name'   => $this->name,
            'city'   => ['class' => 'Lthrt_ContactBundle_Entity_City', 'id' => []],
            'county' => ['class' => 'Lthrt_ContactBundle_Entity_County', 'id' => []],
            'zip'    => ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => []],
        ];

        if ($full) {
            $json = array_merge($json,
                [
                    'city'   => $this->city->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_City', 'id' => $e->getId()];})->toArray(),
                    'county' => $this->county->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_County', 'id' => $e->getId()];})->toArray(),
                    'zip'    => $this->zip->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Zip', 'id' => $e->getId()];})->toArray(),
                ]
            );
        }

        return $json;
    }

}
