<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\AddressType;

/**
 * AddressTypeNotFoundTrait.
 */


trait AddressTypeNotFoundTrait
{
    private function notFound(AddressType $addresstype)
    {
        if (!$addresstype) {
            throw $this->createNotFoundException('Unable to find AddressType entity.');
        }
    }
}
