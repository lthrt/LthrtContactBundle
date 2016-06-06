<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\Zip;

/**
 * ZipNotFoundTrait.
 */
trait ZipNotFoundTrait
{
    private function notFound(Zip $zip)
    {
        if (!$zip) {
            throw $this->createNotFoundException('Unable to find Zip entity.');
        }
    }
}
