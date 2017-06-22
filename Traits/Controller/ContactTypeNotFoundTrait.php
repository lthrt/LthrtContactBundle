<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\ContactType;

/**
 * ContactTypeNotFoundTrait.
 */
trait ContactTypeNotFoundTrait
{
    private function ifNotFound(ContactType $contacttype)
    {
        if (!$contacttype) {
            throw $this->createNotFoundException('Unable to find ContactType entity.');
        }
    }
}
