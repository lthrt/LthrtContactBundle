<?php

namespace Lthrt\ContactBundle\Controller\ControllerTrait;

use Lthrt\ContactBundle\Entity\Demographic;
use Lthrt\ContactBundle\Form\DemographicType;

//
// DemographicFormController Trait.
//

trait DemographicFormController
{
    //
    // Creates a form to create a Demographic entity.
    //
    // @param Demographic $demographic The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createCreateForm(Demographic $demographic)
    {
        $form = $this->createForm(new DemographicType(), $demographic, [
            'action' => $this->generateUrl('demographic_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'Create']);

        return $form;
    }

    //
    // Creates a form to delete a Demographic entity by id.
    //
    // @param mixed $demographic The entity id
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createDeleteForm(Demographic $demographic)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demographic_delete', ['demographic' => $demographic->getId()]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, ['label' => 'Delete'])
            ->getForm();
    }

    //
    // Creates a form to edit a Demographic entity.
    //
    // @param Demographic $demographic The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createEditForm(Demographic $demographic)
    {
        $form = $this->createForm(new DemographicType(), $demographic, [
            'action' => $this->generateUrl('demographic_update', ['demographic' => $demographic->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'Update']);

        return $form;
    }
}
