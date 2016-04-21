<?php

namespace Lthrt\ContactBundle\Controller\ControllerTrait;

use Lthrt\ContactBundle\Entity\ContactType;
use Lthrt\ContactBundle\Form\ContactTypeType;

//
// ContactTypeFormController Trait.
//

trait ContactTypeFormController
{
    //
    // Creates a form to create a ContactType entity.
    //
    // @param ContactType $contacttype The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createCreateForm(ContactType $contacttype)
    {
        $form = $this->createForm(new ContactTypeType(), $contacttype, [
            'action' => $this->generateUrl('contacttype_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'Create']);

        return $form;
    }

    //
    // Creates a form to delete a ContactType entity by id.
    //
    // @param mixed $contacttype The entity id
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createDeleteForm(ContactType $contacttype)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contacttype_delete', ['contacttype' => $contacttype->getId()]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, ['label' => 'Delete'])
            ->getForm();
    }

    //
    // Creates a form to edit a ContactType entity.
    //
    // @param ContactType $contacttype The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createEditForm(ContactType $contacttype)
    {
        $form = $this->createForm(new ContactTypeType(), $contacttype, [
            'action' => $this->generateUrl('contacttype_update', ['contacttype' => $contacttype->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'Update']);

        return $form;
    }
}
