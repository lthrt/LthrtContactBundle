<?php
namespace  Lthrt\ContactBundle\DataFixtures;

use Lthrt\ContactBundle\Entity\State;
use Lthrt\ContactBundle\DataFixtures\DataTrait\StatesTrait;

class StatesLoader
{
    use StatesTrait;

   // because of length, source array at end of class


    private $em;

    public function __construct($em)
    {
        $this->em = $em;
        $this->getStates();
    }

    public function load($overwrite = false)
    {
        $dbStates = $this->em->getRepository('LthrtContactBundle:State')
        ->createQueryBuilder('state', 'state.abbr')->getQuery()->getResult();

        ksort($this->states);
        $missingStates = array_diff_key($this->states, $dbStates);

        foreach ($missingStates as $abbr => $name) {
            $state = new State();
            $state->setAbbr($abbr);
            $state->setName($name);
            $this->em->persist($state);
        }

        $this->em->flush();
        ksort($missingStates);
        return $missingStates;
    }
}
