<?php

namespace Lthrt\ContactBundle\Repository;

use Lthrt\ContactBundle\Repository\RepositoryTrait\ContactBundleRepositoryTrait;

/**
 * CountyRepository
 * All methods return query builders.
 */
class CountyRepository extends \Doctrine\ORM\EntityRepository
{
    use ContactBundleRepositoryTrait;

    const ROOT = 'county';

    public function findByCityName($name)
    {
        return $this->findByCityAndOrState(['city' => $name]);
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
        return $this->findByCityAndOrState(['state' => $abbr]);
    }
}
