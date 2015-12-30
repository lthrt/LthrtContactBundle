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

    public function findByCounty($name){
        $qb = $this->findAll();
        $qb->join(self::ROOT.'.county', StateRepository::ROOT);
        $qb->andWhere($qb->expr()->eq(CountRepository::ROOT.'.name', ':name'));
        $qb->setParameter('name', $name);
        return $qb;
    }
}