<?php

namespace Lthrt\ContactBundle\Repository;

use Lthrt\ContactBundle\Repository\RepositoryTrait\ContactBundleRepository;

/**
 * StateRepository.
 * All methods return query builders.
 */
class StateRepository extends \Doctrine\ORM\EntityRepository
{
    use ContactBundleRepository;

    const ROOT = 'state';

    public function findStates()
    {
        $qb = $this->qb('abbr');
        $qb->addOrderBy(self::ROOT . '.abbr');

        return $qb;
    }

    public function findByCity($name)
    {
        return $this->findByCityAndOrCounty(['city'=> $name]);
    }

    public function findByCityAndOrCounty($options)
    {
        $options = array_merge(
            [
                'city'   => null,
                'county' => null,
            ],
            $options
        );

        $qb = $this->findStates();

        if ($options['city']) {
            $qb->join(self::ROOT . '.city', CityRepository::ROOT);
            $qb->andWhere($qb->expr()->eq(CityRepository::ROOT . '.name', ':city'));
            $qb->setParameter('city', $options['city']);
        }

        if ($options['county']) {
            $qb->join(self::ROOT . '.county', CountyRepository::ROOT);
            $qb->andWhere($qb->expr()->eq(CountyRepository::ROOT . '.name', ':county'));
            $qb->setParameter('county', $options['county']);
        }

        return $qb;
    }

    public function findByCounty($name)
    {
        return $this->findByCityAndOrCounty(['county'=> $name]);
    }



}
