<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\Contact;
use Lthrt\ContactBundle\Form\ContactType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * ContactFormController Trait.
 */


trait ContactFormTrait
{
    /**
     * Creates a form to delete a Contact entity by id.
     *
     * @param mixed $contact The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contact $contact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contact_known', [ 'contact' => $contact->getId() ]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, [ 'label' => 'Delete' ])
            ->getForm()
        ;
    }

    /**
     * Creates a form to edit a Contact entity.
     *
     * @param Contact $contact The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Contact $contact = null)
    {
        if ($contact->getId()) {
            $form = $this->createForm(ContactType::class, $contact, [
                'action' => $this->generateUrl('contact_known', [ 'contact' => $contact->getId() ]),
                'method' => 'PUT',
            ]);

            return $form;
        } else {
            $form = $this->createForm(ContactType::class, new Contact(), [
                'action' => $this->generateUrl('contact_new'),
                'method' => 'PUT',
            ]);

            return $form;
        }
    }

}