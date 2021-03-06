<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\Address;

/**
 * AddressNotFoundTrait.
 */
trait AddressNotFoundTrait
{
    private function ifNotFound(Address $address)
    {
        if (!$address) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }
    }
}
