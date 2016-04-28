<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\County;
use Lthrt\ContactBundle\Form\CountyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * CountyFormController Trait.
 */


trait CountyFormTrait
{
    /**
     * Creates a form to delete a County entity by id.
     *
     * @param mixed $county The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(County $county)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('county_delete', [ 'county' => $county->getId() ]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, [ 'label' => 'Delete' ])
            ->getForm()
        ;
    }

    /**
     * Creates a form to edit a County entity.
     *
     * @param County $county The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(County $county = null)
    {
        if ($county->getId()) {
            $form = $this->createForm(CountyType::class, $county, [
                'action' => $this->generateUrl('county_known', [ 'county' => $county->getId() ]),
                'method' => 'PUT',
            ]);

            return $form;
        } else {
            $form = $this->createForm(CountyType::class, new County(), [
                'action' => $this->generateUrl('county_new'),
                'method' => 'PUT',
            ]);

            return $form;
        }
    }
g

}