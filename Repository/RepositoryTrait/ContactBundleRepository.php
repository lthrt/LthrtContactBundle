<?php

namespace Lthrt\ContactBundle\Repository\RepositoryTrait;


//
// AddressFormRepository Trait.
//


trait ContactBundleRepository
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
}
