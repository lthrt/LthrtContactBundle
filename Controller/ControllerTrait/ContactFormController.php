<?php

namespace Lthrt\ContactBundle\Controller\ControllerTrait;

use Lthrt\ContactBundle\Entity\Contact;
use Lthrt\ContactBundle\Form\ContactType;

//
// ContactFormController Trait.
//

trait ContactFormController
{
    //
    // Creates a form to create a Contact entity.
    //
    // @param Contact $contact The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createCreateForm(Contact $contact)
    {
        $form = $this->createForm(new ContactType(), $contact, [
            'action' => $this->generateUrl('contact_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'Create']);

        return $form;
    }

    //
    // Creates a form to delete a Contact entity by id.
    //
    // @param mixed $contact The entity id
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createDeleteForm(Contact $contact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contact_delete', ['contact' => $contact->getId()]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, ['label' => 'Delete'])
            ->getForm();
    }

    //
    // Creates a form to edit a Contact entity.
    //
    // @param Contact $contact The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createEditForm(Contact $contact)
    {
        $form = $this->createForm(new ContactType(), $contact, [
            'action' => $this->generateUrl('contact_update', ['contact' => $contact->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'Update']);

        return $form;
    }
}
