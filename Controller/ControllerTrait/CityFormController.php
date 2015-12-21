<?php

namespace Lthrt\ContactBundle\Controller\ControllerTrait;

use Lthrt\ContactBundle\Entity\City;
use Lthrt\ContactBundle\Form\CityType;

//
// CityFormController Trait.
//


trait CityFormController
{
    //
    // Creates a form to create a City entity.
    //
    // @param City $city The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createCreateForm(City $city)
    {
        $form = $this->createForm(new CityType(), $city, [
            'action' => $this->generateUrl('city_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', [ 'label' => 'Create' ]);

        return $form;
    }

    //
    // Creates a form to delete a City entity by id.
    //
    // @param mixed $city The entity id
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createDeleteForm(City $city)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('city_delete', [ 'city' => $city->getId() ]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', [ 'label' => 'Delete' ])
            ->getForm();
    }

    //
    // Creates a form to edit a City entity.
    //
    // @param City $city The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createEditForm(City $city)
    {
        $form = $this->createForm(new CityType(), $city, [
            'action' => $this->generateUrl('city_update', [ 'city' => $city->getId() ]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Update']);

        return $form;
    }
}
