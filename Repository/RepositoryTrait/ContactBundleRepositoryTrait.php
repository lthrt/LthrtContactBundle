<?php

namespace Lthrt\ContactBundle\Repository\RepositoryTrait;

//
// AddressFormRepository Trait.
//


trait ContactBundleRepositoryTrait
{
    private function qb($index = null)
    {
        if ($index) {
            $qb = $this->createQueryBuilder(self::ROOT, self::ROOT . '.' . $index);
        } else {
            $qb = $this->createQueryBuilder(self::ROOT);
        }

        return $qb;
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
