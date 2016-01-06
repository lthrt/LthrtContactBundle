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

    public function findByCityName($name)
    {
        return $this->findByCityAndOrState(['city'=> $name]);
    }

    public function findByCityAndOrState($options)
    {
        $options = array_merge(
            [
                'city'  => null,
                'state' => null,
            ],
            $options
        );

        $qb = $this->findNames();

        if ($options['city']) {
            $qb->join(self::ROOT . '.city', CityRepository::ROOT);
            $qb->andWhere($qb->expr()->eq(CityRepository::ROOT . '.name', ':city'));
            $qb->setParameter('city', $options['city']);
        }

        if ($options['state']) {
            $qb->join(self::ROOT . '.state', StateRepository::ROOT);
            $qb->andWhere($qb->expr()->eq(StateRepository::ROOT . '.abbr', ':state'));
            $qb->setParameter('state', $options['state']);
        }

        return $qb;
    }

    public function findByStateAbbr($abbr)
    {
        return $this->findByCountyAndOrState(['state'=> $abbr]);
    }

    public function findNames()
    {
        $qb = $this->qb();
        $qb->orderBy(self::ROOT . '.name');
        $qb->select(self::ROOT . '.name');
        $qb->distinct();

        return $qb;
    }
}
