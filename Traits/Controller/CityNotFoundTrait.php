<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\City;

/**
 * CityNotFoundTrait.
 */
trait CityNotFoundTrait
{
    private function notFound(City $city)
    {
        if (!$city) {
            throw $this->createNotFoundException('Unable to find City entity.');
        }
    }
}
