<?php

namespace Lthrt\ContactBundle\Repository;

/**
 * DemographicRepository.
 */
class DemographicRepository extends \Doctrine\ORM\EntityRepository
{
    public function getOrderedTypes($demographicType = null)
    {
        $qb = $this->createQueryBuilder('demo');
        $qb->addOrderBy('demo.value');
        if ($demographicType) {
            $qb->join('demo.type', 'demoType', 'WITH', $qb->expr()->eq('demoType.name', ':type'));
            $qb->setParameter('type', $demographicType);
        } else {
            $qb->join('demo.type', 'demoType');
        }

        return $qb;
    }
}
