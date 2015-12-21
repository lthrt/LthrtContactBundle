<?php

namespace Lthrt\ContactBundle\Controller\ControllerTrait;
use Lthrt\ContactBundle\Entity\Zip;
use Lthrt\ContactBundle\Form\ZipType;

//
// ZipFormController Trait.
//


trait ZipFormController
{


    //
    // Creates a form to create a Zip entity.
    //
    // @param Zip $zip The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createCreateForm(Zip $zip)
    {
        $form = $this->createForm(new ZipType(), $zip, [
            'action' => $this->generateUrl('zip_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', [ 'label' => 'Create' ]);

        return $form;
    }

    //
    // Creates a form to delete a Zip entity by id.
    //
    // @param mixed $zip The entity id
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createDeleteForm(Zip $zip)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zip_delete', [ 'zip' => $zip->getId() ]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', [ 'label' => 'Delete' ])
            ->getForm()
        ;
    }

    //
    // Creates a form to edit a Zip entity.
    //
    // @param Zip $zip The entity
    //
    // @return \Symfony\Component\Form\Form The form
    //
    private function createEditForm(Zip $zip)
    {
        $form = $this->createForm(new ZipType(), $zip, [
            'action' => $this->generateUrl('zip_update', [ 'zip' => $zip->getId() ]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Update']);

        return $form;
    }

}