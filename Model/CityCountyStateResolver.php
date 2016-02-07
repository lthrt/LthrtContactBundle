<?php

namespace Lthrt\ContactBundle\Controller;

use Lthrt\ContactBundle\Entity\City;
use Lthrt\ContactBundle\Entity\County;
use Lthrt\ContactBundle\Entity\State;
use Lthrt\ContactBundle\Repository\CityRepository;
use Lthrt\ContactBundle\Repository\CountyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//
// County controller.
//
//

class CityCountyStateResolver
{
    private $cityRep;
    private $countyRep;
    private $stateRep;

    public function __construct($em)
    {
        $this->options = array_merge(
            [
                'county' => null,
                'state'  => null,
                'city'   => null,
            ],
            $options
        );
        $this->cityRep   = $em->getRepository('LthrtContactBundle:City');
        $this->countyRep = $em->getRepository('LthrtContactBundle:County');
        $this->stateRep  = $em->getRepository('LthrtContactBundle:State');
    }

    public function resolveCity($city, $county = null, $state = null)
    {
        $qb    = $this->cityRep->findByCountyAndOrState(['county' => $county, 'state' => $state]);
        $count = $qb->select($qb->expr()->count(CityRepository::ROOT))->getQuery()->getSingleScalarResult();

        return $count;
    }

    public function resolveCounty($city, $county = null, $state = null)
    {
        $qb    = $this->cityRep->findByCityAndOrState(['city' => $city, 'state' => $state]);
        $count = $qb->select($qb->expr()->count(CountyRepository::ROOT))->getQuery()->getSingleScalarResult();

        return $count;
    }
}
