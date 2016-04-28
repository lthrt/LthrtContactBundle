<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\AddressType;
use Lthrt\ContactBundle\Form\AddressTypeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * AddressTypeFormController Trait.
 */


trait AddressTypeFormTrait
{
    /**
     * Creates a form to delete a AddressType entity by id.
     *
     * @param mixed $addresstype The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AddressType $addresstype)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('addresstype_known', [ 'addresstype' => $addresstype->getId() ]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, [ 'label' => 'Delete' ])
            ->getForm()
        ;
    }

    /**
     * Creates a form to edit a AddressType entity.
     *
     * @param AddressType $addresstype The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(AddressType $addresstype = null)
    {
        if ($addresstype->getId()) {
            $form = $this->createForm(AddressTypeType::class, $addresstype, [
                'action' => $this->generateUrl('addresstype_known', [ 'addresstype' => $addresstype->getId() ]),
                'method' => 'PUT',
            ]);

            return $form;
        } else {
            $form = $this->createForm(AddressTypeType::class, new AddressType(), [
                'action' => $this->generateUrl('addresstype_new'),
                'method' => 'PUT',
            ]);

            return $form;
        }
    }

}