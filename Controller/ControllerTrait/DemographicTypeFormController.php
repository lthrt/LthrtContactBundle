<?php

namespace Lthrt\ContactBundle\Controller\ControllerTrait;

use Lthrt\ContactBundle\Entity\DemographicType;
use Lthrt\ContactBundle\Form\DemographicTypeType;

//
// DemographicTypeFormController Trait.
//


trait DemographicTypeFormController
{
    //
    // Creates a form to create a DemographicType entity.
    //
    // @param DemographicType $demographictype The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createCreateForm(DemographicType $demographictype)
    {
        $form = $this->createForm(new DemographicTypeType(), $demographictype, [
            'action' => $this->generateUrl('demographictype_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', [ 'label' => 'Create' ]);

        return $form;
    }

    //
    // Creates a form to delete a DemographicType entity by id.
    //
    // @param mixed $demographictype The entity id
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createDeleteForm(DemographicType $demographictype)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demographictype_delete', [ 'demographictype' => $demographictype->getId() ]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', [ 'label' => 'Delete' ])
            ->getForm();
    }

    //
    // Creates a form to edit a DemographicType entity.
    //
    // @param DemographicType $demographictype The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createEditForm(DemographicType $demographictype)
    {
        $form = $this->createForm(new DemographicTypeType(), $demographictype, [
            'action' => $this->generateUrl('demographictype_update', [ 'demographictype' => $demographictype->getId() ]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Update']);

        return $form;
    }
}
