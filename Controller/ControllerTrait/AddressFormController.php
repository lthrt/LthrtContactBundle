<?php

namespace Lthrt\ContactBundle\Controller\ControllerTrait;

use Lthrt\ContactBundle\Entity\Address;
use Lthrt\ContactBundle\Form\AddressType;

//
// AddressFormController Trait.
//

trait AddressFormController
{
    //
    // Creates a form to create a Address entity.
    //
    // @param Address $address The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createCreateForm(Address $address)
    {
        $form = $this->createForm(new AddressType(), $address, [
            'action' => $this->generateUrl('address_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'Create']);

        return $form;
    }

    //
    // Creates a form to delete a Address entity by id.
    //
    // @param mixed $address The entity id
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createDeleteForm(Address $address)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('address_delete', ['address' => $address->getId()]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, ['label' => 'Delete'])
            ->getForm();
    }

    //
    // Creates a form to edit a Address entity.
    //
    // @param Address $address The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createEditForm(Address $address)
    {
        $form = $this->createForm(new AddressType(), $address, [
            'action' => $this->generateUrl('address_update', ['address' => $address->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'Update']);

        return $form;
    }
}
