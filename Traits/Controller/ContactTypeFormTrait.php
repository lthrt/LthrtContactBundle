<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\ContactType;
use Lthrt\ContactBundle\Form\ContactTypeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * ContactTypeFormController Trait.
 */

trait ContactTypeFormTrait
{
    /**
     * Creates a form to delete a ContactType entity by id.
     *
     * @param mixed $contacttype The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ContactType $contacttype)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contacttype', ['contacttype' => $contacttype->getId()]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, ['label' => 'Delete'])
            ->getForm()
        ;
    }

    /**
     * Creates a form to edit a ContactType entity.
     *
     * @param ContactType $contacttype The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ContactType $contacttype = null)
    {
        if ($contacttype->getId()) {
            $form = $this->createForm(ContactTypeType::class, $contacttype, [
                'action' => $this->generateUrl('contacttype', ['contacttype' => $contacttype->getId()]),
                'method' => 'PUT',
            ]);

            return $form;
        } else {
            $form = $this->createForm(ContactTypeType::class, new ContactType(), [
                'action' => $this->generateUrl('contacttype_new'),
                'method' => 'PUT',
            ]);

            return $form;
        }
    }
}
