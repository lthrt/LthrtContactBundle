<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\Demographic;
use Lthrt\ContactBundle\Form\DemographicType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * DemographicFormController Trait.
 */


trait DemographicFormTrait
{
    /**
     * Creates a form to delete a Demographic entity by id.
     *
     * @param mixed $demographic The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Demographic $demographic)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demographic_known', [ 'demographic' => $demographic->getId() ]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, [ 'label' => 'Delete' ])
            ->getForm()
        ;
    }

    /**
     * Creates a form to edit a Demographic entity.
     *
     * @param Demographic $demographic The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Demographic $demographic = null)
    {
        if ($demographic->getId()) {
            $form = $this->createForm(DemographicType::class, $demographic, [
                'action' => $this->generateUrl('demographic_known', [ 'demographic' => $demographic->getId() ]),
                'method' => 'PUT',
            ]);

            return $form;
        } else {
            $form = $this->createForm(DemographicType::class, new Demographic(), [
                'action' => $this->generateUrl('demographic_new'),
                'method' => 'PUT',
            ]);

            return $form;
        }
    }

}