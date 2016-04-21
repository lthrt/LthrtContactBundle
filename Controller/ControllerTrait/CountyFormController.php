<?php

namespace Lthrt\ContactBundle\Controller\ControllerTrait;

use Lthrt\ContactBundle\Entity\County;
use Lthrt\ContactBundle\Form\CountyType;

//
// CountyFormController Trait.
//

trait CountyFormController
{
    //
    // Creates a form to create a County entity.
    //
    // @param County $county The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createCreateForm(County $county)
    {
        $form = $this->createForm(new CountyType(), $county, [
            'action' => $this->generateUrl('county_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'Create']);

        return $form;
    }

    //
    // Creates a form to delete a County entity by id.
    //
    // @param mixed $county The entity id
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createDeleteForm(County $county)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('county_delete', ['county' => $county->getId()]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, ['label' => 'Delete'])
            ->getForm();
    }

    //
    // Creates a form to edit a County entity.
    //
    // @param County $county The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createEditForm(County $county)
    {
        $form = $this->createForm(new CountyType(), $county, [
            'action' => $this->generateUrl('county_update', ['county' => $county->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'Update']);

        return $form;
    }
}
