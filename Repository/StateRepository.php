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

    public function findAll()
    {
        $qb = $this->qb('abbr');
        $qb->addOrderBy(self::ROOT . '.abbr');

        return $qb;
    }

    public function findByCity($name)
    {
        $cityRep = $this->getEntityManager()->getRepository('LthrtContactBundle:City');
        $qb      = $this->findAll();
//much work to do where
        return $qb;
    }

    public function findByCounty($name)
    {
        $qb = $this->findAll();
        $qb->join(self::ROOT . '.county', CountyRepository::ROOT);
        $qb->andWhere($qb->expr()->eq(CountyRepository::ROOT . '.name', ':name'));
        $qb->setParameter('name', $name);

        return $qb;
    }
}
