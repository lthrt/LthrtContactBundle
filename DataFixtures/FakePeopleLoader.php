<?php
namespace Lthrt\ContactBundle\DataFixtures;

use Lthrt\ContactBundle\DataFixtures\DataTrait\FakePeopleTrait;
use Lthrt\ContactBundle\Entity\Demographic;
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

    public function getRaces()
    {

        $qb = $this->em->getRepository('LthrtContactBundle:Demographic')
            ->createQueryBuilder('race', 'race.value');
        $qb->join('race.type', 'demotype')
            ->andWhere($qb->expr()->eq('demotype.name', ':demotype'))
            ->setParameter('demotype', 'race');

        return $qb->getQuery()->getResult();
    }

    public function getEthnicities()
    {

        $qb = $this->em->getRepository('LthrtContactBundle:Demographic')
            ->createQueryBuilder('race', 'race.value');
        $qb->join('race.type', 'demotype')
            ->andWhere($qb->expr()->eq('demotype.name', ':demotype'))
            ->setParameter('demotype', 'ethnicity');

        return $qb->getQuery()->getResult();
    }

    public function loadFakePeople($overwrite = false)
    {
        $dbPeople = $this->em->getRepository('LthrtContactBundle:Person')
            ->createQueryBuilder('people')->getQuery()->getResult();
        $races       = $this->getRaces();
        $ethnicities = $this->getEthnicities();
        $raceType    = $this->em->getRepository('LthrtContactBundle:DemographicType')
            ->createQueryBuilder('demotype');
        $raceType = $raceType
            ->andWhere($raceType->expr()->eq('demotype.name', ':demotype'))
            ->setParameter('demotype', 'race')->getQuery()->getOneOrNullResult();
        $ethnicityType = $this->em->getRepository('LthrtContactBundle:DemographicType')
            ->createQueryBuilder('demotype');
        $ethnicityType = $ethnicityType
            ->andWhere($ethnicityType->expr()->eq('demotype.name', ':demotype'))
            ->setParameter('demotype', 'ethnicity')->getQuery()->getOneOrNullResult();

        if ($raceType) {
        } else {
            throw new \Exception("Demographic types must be loaded first. \n" . __FILE__ . ': ' . __LINE__);
        }

        $updatedPeople = [];
        $updates       = [];
        $new           = [];

        // Sample data does not have last/first collisions
        foreach ($dbPeople as $key => $person) {
            $updatedPeople[$person->lastName][$person->firstName] = $person;
        }

        unset($dbPeople);

        foreach ($this->people as $lastName => $rest) {
            foreach ($rest as $firstName => $dataRow) {
                if ('header' == $lastName) {
                    continue;
                }
                $last      = $dataRow[$this->people['header']['last']];
                $first     = $dataRow[$this->people['header']['first']];
                $dob       = $dataRow[$this->people['header']['dob']];
                $race      = $dataRow[$this->people['header']['race']];
                $ethnicity = $dataRow[$this->people['header']['ethnicity']];

                if ($race && isset($races[$race])) {
                } else {
                    $newRace        = new Demographic();
                    $newRace->value = $race;
                    $newRace->type  = $raceType;
                    $this->em->persist($newRace);
                    $this->em->flush();
                    $races = $this->getRaces();
                }

                if ($ethnicity && isset($ethnicities[$ethnicity])) {
                } else {
                    $newEthnicity        = new Demographic();
                    $newEthnicity->value = $ethnicity;
                    $newEthnicity->type  = $ethnicityType;
                    $this->em->persist($newEthnicity);
                    $this->em->flush();
                    $ethnicities = $this->getEthnicities();
                }

                if (in_array($last, array_keys($updatedPeople))
                    && in_array($first, array_keys($updatedPeople[$last]))
                ) {
                    $person = $updatedPeople[$last][$first];

                    $updates[$person->firstName . " " . $person->lastName] = 1;
                } else {
                    $person                    = new Person();
                    $newPeople[$last][$first]  = $person;
                    $new[$first . " " . $last] = 1;
                    unset($updatedPeople[$last][$first]);
                }
                $person->firstName = $first;
                $person->lastName  = $last;
                $person->dob       = new \DateTime($dob);
                if ($race) {
                    $person->addDemographic($races[$race]);
                }
                if ($ethnicity) {
                    $person->addDemographic($ethnicities[$ethnicity]);
                }
                $this->em->persist($person);
                $this->em->flush();
            }
        }

        return ['updates' => $updates, 'new' => $new];
    }
}
