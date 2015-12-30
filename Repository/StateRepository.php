<?php

namespace Lthrt\ContactBundle\Repository;

use Lthrt\ContactBundle\Repository\RepositoryTrait\ContactBundleRepository;
use Lthrt\ContactBundle\Entity\County;
use Lthrt\ContactBundle\Repository\CountyRepository;

/**
 * StateRepository.
 * All methods return query builders
 */

class StateRepository extends \Doctrine\ORM\EntityRepository
{
    use ContactBundleRepository;

    const ROOT = 'county';

    public function findAll(){
        $qb = $this->qb('abbr');
        $qb->addOrderBy(self::ROOT.'.abbr');
        return $qb;
    }

    public function findByCounty(State $state){
        $qb = $this->findAll();
        $qb->join(self::ROOT.'.county', StateRepository::ROOT);
        return $qb;
    }
}