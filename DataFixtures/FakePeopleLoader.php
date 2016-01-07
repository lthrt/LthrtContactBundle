<?php
namespace  Lthrt\ContactBundle\DataFixtures;

use Lthrt\ContactBundle\DataFixtures\DataTrait\FakePeopleTrait;
use Lthrt\ContactBundle\Entity\Person;

class FakePeopleLoader
{
    use FakePeopleTrait;

   // because of length, source array at end of class


    private $em;

    public function __construct($em)
    {
        $this->em     = $em;
        $this->people = $this->getPeople();
    }

    public function loadFakePeople($overwrite = false)
    {
        $dbPeople = $this->em->getRepository('LthrtContactBundle:Person')
        ->createQueryBuilder('people')->getQuery()->getResult();

        ksort($this->people);

        $updatedPeople = [];
        $newPeople     = [];

        // foreach ($this->people as $abbr => $name) {
        //     if ('header' == $abbr) {
        //         continue;
        //     }
        //     if (in_array($abbr, array_keys($dbPeople))) {
        //         $state                = $dbPeople[$abbr];
        //         $updatedPeople[$abbr] = $state->getAbbr();
        //     } else {
        //         $state            = new Person();
        //         $newPeople[$abbr] = $state->getAbbr();
        //     }
        //     $state->setAbbr($abbr);
        //     $state->setName($name);
        //     $this->em->persist($state);
        //     $this->em->flush();
        // }

        // if ($updatedPeople) {
        //     ksort($updatedPeople);
        // }
        // if ($newPeople) {
        //     ksort($newPeople);
        // }
more work here
        return ['updatedPeople' => $updatedPeople, 'newPeople' => $newPeople];
    }
}
