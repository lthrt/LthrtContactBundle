<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\Contact;

/**
 * ContactNotFoundTrait.
 */
trait ContactNotFoundTrait
{
    private function ifNotFound(Contact $contact)
    {
        if (!$contact) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }
    }
}
