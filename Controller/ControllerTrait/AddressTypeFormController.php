<?php

namespace Lthrt\ContactBundle\Controller\ControllerTrait;

use Lthrt\ContactBundle\Entity\AddressType;
use Lthrt\ContactBundle\Form\AddressTypeType;

//
// AddressTypeFormController Trait.
//


trait AddressTypeFormController
{
    //
    // Creates a form to create a AddressType entity.
    //
    // @param AddressType $addresstype The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createCreateForm(AddressType $addresstype)
    {
        $form = $this->createForm(new AddressTypeType(), $addresstype, [
            'action' => $this->generateUrl('addresstype_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', [ 'label' => 'Create' ]);

        return $form;
    }

    //
    // Creates a form to delete a AddressType entity by id.
    //
    // @param mixed $addresstype The entity id
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createDeleteForm(AddressType $addresstype)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('addresstype_delete', [ 'addresstype' => $addresstype->getId() ]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', [ 'label' => 'Delete' ])
            ->getForm();
    }

    //
    // Creates a form to edit a AddressType entity.
    //
    // @param AddressType $addresstype The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createEditForm(AddressType $addresstype)
    {
        $form = $this->createForm(new AddressTypeType(), $addresstype, [
            'action' => $this->generateUrl('addresstype_update', [ 'addresstype' => $addresstype->getId() ]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Update']);

        return $form;
    }
}
