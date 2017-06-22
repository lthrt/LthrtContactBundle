<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\Demographic;

/**
 * DemographicNotFoundTrait.
 */
trait DemographicNotFoundTrait
{
    private function ifNotFound(Demographic $demographic)
    {
        if (!$demographic) {
            throw $this->createNotFoundException('Unable to find Demographic entity.');
        }
    }
}
