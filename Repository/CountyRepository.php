<?php

namespace Lthrt\ContactBundle\Repository;

use Lthrt\ContactBundle\Entity\State;
use Lthrt\ContactBundle\Repository\StateRepository;
use Lthrt\ContactBundle\Repository\RepositoryTrait\ContactBundleRepository;

/**
 * CountyRepository
 * All methods return query builders
 */

class CountyRepository extends \Doctrine\ORM\EntityRepository
{
    use ContactBundleRepository;

    const ROOT = 'county';

    public function findAll(){
        $qb = $this->createQueryBuilder(self::ROOT);
        $qb->orderBy(self::ROOT.'.name');
        return $qb;
    }
    public function findByState(State $state){
        $qb = $this->findAll();
        $qb->join(self::ROOT.'.state', StateRepository::ROOT);
        return $qb;
    }
}
