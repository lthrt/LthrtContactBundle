<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\County;

/**
 * CountyNotFoundTrait.
 */
trait CountyNotFoundTrait
{
    private function notFound(County $county)
    {
        if (!$county) {
            throw $this->createNotFoundException('Unable to find County entity.');
        }
    }
}
