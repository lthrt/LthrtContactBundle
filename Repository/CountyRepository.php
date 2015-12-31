<?php

namespace Lthrt\ContactBundle\Repository;

use Lthrt\ContactBundle\Repository\RepositoryTrait\ContactBundleRepository;

/**
 * CountyRepository
 * All methods return query builders.
 */
class CountyRepository extends \Doctrine\ORM\EntityRepository
{
    use ContactBundleRepository;

    const ROOT = 'county';

    public function findNames()
    {
        $qb = $this->qb();
        $qb->orderBy(self::ROOT . '.name');
        $qb->select(self::ROOT . '.name');
        $qb->distinct();

        return $qb;
    }

    public function findByStateAbbr($abbr)
    {
        $qb = $this->findNames();
        $qb->join(self::ROOT . '.state', StateRepository::ROOT);
        $qb->andWhere($qb->expr()->eq(StateRepository::ROOT . '.abbr', ':abbr'));
        $qb->setParameter('abbr', $abbr);

        return $qb;
    }
}
