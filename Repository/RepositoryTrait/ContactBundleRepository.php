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
        $qb = $this->createQueryBuilder(SELF::ROOT, self::ROOT.'.'.$index);
        return $qb;
    }
}