<?php
namespace Lthrt\ContactBundle\DataFixtures;

use Lthrt\ContactBundle\DataFixtures\DataTrait\StatesTrait;
use Lthrt\ContactBundle\Entity\State;

class StatesLoader
{
    use StatesTrait;

    // because of length, source array at end of class

    private $em;

    public function __construct($em)
    {
        $this->em     = $em;
        $this->states = $this->getStates();
    }

    public function loadStates($overwrite = false)
    {
        $dbStates = $this->em->getRepository('LthrtContactBundle:State')
            ->createQueryBuilder('state', 'state.abbr')->getQuery()->getResult();

        ksort($this->states);

        $updatedStates = [];
        $newStates     = [];

        foreach ($this->states as $abbr => $name) {
            if ('header' == $abbr) {
                continue;
            }
            if (in_array($abbr, array_keys($dbStates))) {
                $state                = $dbStates[$abbr];
                $updatedStates[$abbr] = $state->abbr;
            } else {
                $state            = new State();
                $newStates[$abbr] = $state->abbr;
            }
            $state->abbr      = $abbr;
            $state->name      = $name;
            $state->updatedBy = "DataFixtures";
            $this->em->persist($state);
            $this->em->flush();
        }

        if ($updatedStates) {
            ksort($updatedStates);
        }
        if ($newStates) {
            ksort($newStates);
        }

        return ['updatedStates' => $updatedStates, 'newStates' => $newStates];
    }
}
