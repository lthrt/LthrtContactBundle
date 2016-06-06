<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\State;

/**
 * StateNotFoundTrait.
 */
trait StateNotFoundTrait
{
    private function notFound(State $state)
    {
        if (!$state) {
            throw $this->createNotFoundException('Unable to find State entity.');
        }
    }
}
