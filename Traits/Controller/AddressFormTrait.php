<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\Address;
use Lthrt\ContactBundle\Form\AddressType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * AddressFormController Trait.
 */


trait AddressFormTrait
{
    /**
     * Creates a form to delete a Address entity by id.
     *
     * @param mixed $address The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Address $address)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('address_delete', [ 'address' => $address->getId() ]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, [ 'label' => 'Delete' ])
            ->getForm()
        ;
    }

    /**
     * Creates a form to edit a Address entity.
     *
     * @param Address $address The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Address $address = null)
    {
        if ($address->getId()) {
            $form = $this->createForm(AddressType::class, $address, [
                'action' => $this->generateUrl('address_known', [ 'address' => $address->getId() ]),
                'method' => 'PUT',
            ]);

            return $form;
        } else {
            $form = $this->createForm(AddressType::class, new Address(), [
                'action' => $this->generateUrl('address_new'),
                'method' => 'PUT',
            ]);

            return $form;
        }
    }
g

}