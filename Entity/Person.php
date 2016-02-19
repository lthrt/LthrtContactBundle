<?php

namespace Lthrt\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lthrt\ContactBundle\Repository\PersonRepository")
 *
 */

class Person implements \JSONSerializable
{
    use \Lthrt\EntityJSONBundle\Entity\ActiveTrait;
    use \Lthrt\EntityJSONBundle\Entity\EntityTrait;
    use \Lthrt\EntityJSONBundle\Entity\LoggedTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="date")
     */
    private $dob;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Contact")
     * @ORM\JoinTable(name="person__contact",
     *     joinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")})
     *     inverseJoinColumns={@ORM\JoinColumn(name="contact_id", referencedColumnName="id")}
     * )
     */

    private $contact;
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Demographic")
     * @ORM\JoinTable(name="person__demographic",
     *     joinColumns={@Orm\Joincolumn(name="person_id", referencedColumnName="id")})
     *     inverseJoinColumns={@Orm\Joincolumn(name="demographic_id", referencedColumnName="id")}
     * )
     */
    private $demographic;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Address")
     * @ORM\JoinTable(name="person__address",
     *     joinColumns={@Orm\Joincolumn(name="person_id", referencedColumnName="id")})
     *     inverseJoinColumns={@Orm\Joincolumn(name="address_id", referencedColumnName="id")}
     * )
     */

    private $address;

    /** jsonSerialize
     *
     */
    public function JSONSerialize($full = true)
    {
        $json = [
            'class'       => 'Lthrt_ContactBundle_Entity_Person',
            'id'          => $this->id,
            'active'      => $this->active,
            'firstName'   => $this->firstName,
            'lastName'    => $this->lastName,
            'dob'         => $this->dob,
            'contact'     => ['class' => 'Lthrt_ContactBundle_Entity_Contact', 'id' => []],
            'demographic' => ['class' => 'Lthrt_ContactBundle_Entity_Demographic', 'id' => []],
            'address'     => ['class' => 'Lthrt_ContactBundle_Entity_Address', 'id' => []],
        ];

        if ($full) {
            $json = array_merge($json,
                [
                    'contact'     => $this->contact->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Contact', 'id' => $e->getId()];})->toArray(),
                    'demographic' => $this->demographic->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Demographic', 'id' => $e->getId()];})->toArray(),
                    'address'     => $this->address->map(function ($e) {return ['class' => 'Lthrt_ContactBundle_Entity_Address', 'id' => $e->getId()];})->toArray(),
                ]
            );
        }

        return $json;
    }

}
