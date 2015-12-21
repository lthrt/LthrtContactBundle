<?php

namespace Lthrt\ContactBundle\Controller\ControllerTrait;

use Lthrt\ContactBundle\Entity\State;
use Lthrt\ContactBundle\Form\StateType;

//
// StateFormController Trait.
//


trait StateFormController
{
    //
    // Creates a form to create a State entity.
    //
    // @param State $state The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createCreateForm(State $state)
    {
        $form = $this->createForm(new StateType(), $state, [
            'action' => $this->generateUrl('state_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', [ 'label' => 'Create' ]);

        return $form;
    }

    //
    // Creates a form to delete a State entity by id.
    //
    // @param mixed $state The entity id
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createDeleteForm(State $state)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('state_delete', [ 'state' => $state->getId() ]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', [ 'label' => 'Delete' ])
            ->getForm();
    }

    //
    // Creates a form to edit a State entity.
    //
    // @param State $state The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createEditForm(State $state)
    {
        $form = $this->createForm(new StateType(), $state, [
            'action' => $this->generateUrl('state_update', [ 'state' => $state->getId() ]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Update']);

        return $form;
    }
}
