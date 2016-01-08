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

        $updatedPeople = [];
        $updates       = [];
        $new           = [];

        // Sample data does not have last/first collisions
        foreach ($dbPeople as $key => $person) {
            $updatedPeople[$person->getLastName()][$person->getFirstName()] = $person;
        }

        unset($dbPeople);

        foreach ($this->people as $last => $rest) {
            foreach ($rest as $first => $dob) {

                if ('header' == $last) {
                    continue;
                }
                if (in_array($last, array_keys($updatedPeople))
                    && in_array($first, array_keys($updatedPeople[$last]))
                ) {
                    $person = $updatedPeople[$last][$first];
                    $updates[$person->getFirstName()." ".$person->getLastName()] = 1;
                } else {
                    $person = new Person();
                    $newPeople[$last][$first] = $person;
                    $new[$first." ".$last] = 1;
                    unset($updatedPeople[$last][$first]);
                }
                $person->setFirstName($first);
                $person->setLastName($last);
                $person->setDob($dob);
                $this->em->persist($person);
                $this->em->flush();
            }

        }

        return [ 'updates' => $updates, 'new' => $new ];
    }
}
