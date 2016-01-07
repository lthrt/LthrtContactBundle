<?php
namespace  Lthrt\ContactBundle\DataFixtures;

use Lthrt\ContactBundle\DataFixtures\DataTrait\FakePeopleTrait;
use Lthrt\ContactBundle\Entity\State;

class FakePeopleLoader
{
    use FakePeopleTrait;

   // because of length, source array at end of class


    private $em;

    public function __construct($em)
    {
        $this->em     = $em;
        var_dump(__LINE__);
        $this->people = $this->getPeople();
        var_dump(__LINE__);die;
    }

    public function loadPeople($overwrite = false)
    {
        $dbPeople = $this->em->getRepository('LthrtContactBundle:People')
        ->createQueryBuilder('people')->getQuery()->getResult();
var_dump($this->people);die;
        ksort($this->people);

        $updatedPeople = [];
        $newPeople     = [];

        foreach ($this->people as $abbr => $name) {
            if ('header' == $abbr) {
                continue;
            }
            if (in_array($abbr, array_keys($dbPeople))) {
                $state                = $dbPeople[$abbr];
                $updatedPeople[$abbr] = $state->getAbbr();
            } else {
                $state            = new State();
                $newPeople[$abbr] = $state->getAbbr();
            }
            $state->setAbbr($abbr);
            $state->setName($name);
            $this->em->persist($state);
            $this->em->flush();
        }

        if ($updatedPeople) {
            ksort($updatedPeople);
        }
        if ($newPeople) {
            ksort($newPeople);
        }

        return ['updatedPeople' => $updatedPeople, 'newPeople' => $newPeople];
    }
}
