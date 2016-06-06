<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\Person;

/**
 * PersonNotFoundTrait.
 */
trait PersonNotFoundTrait
{
    private function notFound(Person $person)
    {
        if (!$person) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }
    }
}
