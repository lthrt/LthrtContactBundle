<?php

namespace Lthrt\ContactBundle\Repository\RepositoryTrait;

use Lthrt\ContactBundle\Entity\Address;
use Lthrt\ContactBundle\Form\AddressType;

//
// AddressFormRepository Trait.
//


trait ContactBundleRepository
{
    private function qb($index = null){
        if ($index) {
            $qb = $this->createQueryBuilder(self::ROOT, self::ROOT.'.'.$index);
        } else {
            $qb = $this->createQueryBuilder(self::ROOT);
        }

        return $qb;
    }
}