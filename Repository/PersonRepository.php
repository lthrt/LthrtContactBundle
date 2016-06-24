<?php

namespace Lthrt\ContactBundle\Repository;

/**
 * PersonRepository.
 */
class PersonRepository extends \Doctrine\ORM\EntityRepository
{
    public function getDemographicCounts($type)
    {
        $demographicType = $this->getEntityManager()->getRepository('LthrtContactBundle:DemographicType')->findOneByName($type);
        if (!$demographicType) {
            return '{\'error\': \'No such Type: ' . $type . '\'}';
        }

        $qb = $this->createQueryBuilder('person');
        $qb->join('person.demographic', 'demo', 'WITH', $qb->expr()->eq('demo.type', ':type'));
        $qb->setParameter('type', $demographicType);
        $qb->addOrderBy('demo.value');
        $qb->groupBy('demo');
        $qb->select('demo.value AS label');
        $qb->addSelect($qb->expr()->count('person') . ' AS value');

        return json_encode($qb->getQuery()->getResult());
    }

    public function getDemographicCountsCount($type)
    {
        $demographicType = $this->getEntityManager()->getRepository('LthrtContactBundle:DemographicType')->findOneByName($type);
        if (!$demographicType) {
            return '{\'error\': \'No such Type: ' . $type . '\'}';
        }

        $qb = $this->createQueryBuilder('person');
        $qb->join('person.demographic', 'demo', 'WITH', $qb->expr()->eq('demo.type', ':type'));
        $qb->setParameter('type', $demographicType);
        $qb->select($qb->expr()->countDistinct('demo'));

        return $qb->getQuery()->getSingleScalarResult();
    }
}
