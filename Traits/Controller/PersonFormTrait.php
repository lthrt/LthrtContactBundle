<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\Person;
use Lthrt\ContactBundle\Form\PersonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * PersonFormController Trait.
 */
trait PersonFormTrait
{
    /**
     * Creates a form to delete a Person entity by id.
     *
     * @param mixed $person The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Person $person)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('person', ['person' => $person->getId()]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, [
                'label' => 'Delete',
                'attr'  => [
                    'class' => 'form-inline',
                ],
            ]
            )
            ->getForm();
    }

    /**
     * Creates a form to edit a Person entity.
     *
     * @param Person $person The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Person $person = null)
    {
        if ($person->getId()) {
            $form = $this->createForm(PersonType::class, $person, [
                'action' => $this->generateUrl('person', ['person' => $person->getId()]),
                'method' => 'PUT',
            ]);
            $form->add('submit', SubmitType::class, ['label' => 'Save']);

            return $form;
        } else {
            $form = $this->createForm(PersonType::class, new Person(), [
                'action' => $this->generateUrl('person_new'),
                'method' => 'PUT',
            ]);
            $form->add('submit', SubmitType::class, ['label' => 'Save']);

            return $form;
        }
    }
}
