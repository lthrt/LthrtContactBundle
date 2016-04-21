<?php

namespace Lthrt\ContactBundle\Controller\ControllerTrait;

use Lthrt\ContactBundle\Entity\Person;
use Lthrt\ContactBundle\Form\PersonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

//
// PersonFormController Trait.
//

trait PersonFormController
{
    //
    // Creates a form to create a Person entity.
    //
    // @param Person $person The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createCreateForm(Person $person)
    {
        $form = $this->createForm(new PersonType(), $person, [
            'action' => $this->generateUrl('person_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'Create']);

        return $form;
    }

    //
    // Creates a form to delete a Person entity by id.
    //
    // @param mixed $person The entity id
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createDeleteForm(Person $person)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('person_delete', ['person' => $person->getId()]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, ['label' => 'Delete'])
            ->getForm();
    }

    //
    // Creates a form to edit a Person entity.
    //
    // @param Person $person The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createEditForm(Person $person)
    {
        $form = $this->createForm(new PersonType(), $person, [
            'action' => $this->generateUrl('person_update', ['person' => $person->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', SubmitType::class, ['label' => 'Update']);

        return $form;
    }
}
