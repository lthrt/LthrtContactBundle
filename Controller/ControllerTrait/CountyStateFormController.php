<?php

namespace Lthrt\ContactBundle\Controller\ControllerTrait;
use Lthrt\ContactBundle\Entity\County;
use Lthrt\ContactBundle\Entity\State;
use Lthrt\ContactBundle\Form\CountyStateType;

//
// CountyFormController Trait.
//


trait CountyStateFormController
{

    private function createCountyStateForm($options = [])
    {
        $options = array_merge(
            [
                'county' => null,
                'state'  => null,
            ],
            $options
        );

        $form = $this->createForm(
            new CountyStateType($this->getDoctrine()->getManager(), $options),
             null,
            [
                'method' => 'PUT',
            ]
        );

        return $form;
    }
}