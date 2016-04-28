<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\DemographicType;

/**
 * DemographicTypeNotFoundTrait.
 */


trait DemographicTypeNotFoundTrait
{
    private function notFound(DemographicType $demographictype)
    {
        if (!$demographictype) {
            throw $this->createNotFoundException('Unable to find DemographicType entity.');
        }
    }
}
