<?php

namespace Lthrt\ContactBundle\Repository;

use Lthrt\ContactBundle\Repository\RepositoryTrait\ContactBundleRepositoryTrait;

/**
 * CityRepository.
 *
 * All methods return query builders.
 */
class CityRepository extends \Doctrine\ORM\EntityRepository
{
    use ContactBundleRepositoryTrait;

    const ROOT = 'city';

    public function findByCountyName($name)
    {
        return $this->findByCountyAndOrState(['county' => $name]);
    }

    public function findByCountyAndOrState($options)
    {
        $options = array_merge(
            [
                'county' => null,
                'state'  => null,
            ],
            $options
        );

        $qb = $this->findNames();

        if ($options['county']) {
            $qb->join(self::ROOT . '.county', CountyRepository::ROOT);
            $qb->andWhere($qb->expr()->eq(CountyRepository::ROOT . '.name', ':county'));
            $qb->setParameter('county', $options['county']);
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
        return $this->findByCountyAndOrState(['state' => $abbr]);
    }
}
