<?php

namespace Lthrt\ContactBundle\Traits\Controller;

use Lthrt\ContactBundle\Entity\DemographicType;
use Lthrt\ContactBundle\Form\DemographicTypeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * DemographicTypeFormController Trait.
 */

trait DemographicTypeFormTrait
{
    /**
     * Creates a form to delete a DemographicType entity by id.
     *
     * @param mixed $demographictype The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DemographicType $demographictype)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demographictype', ['demographictype' => $demographictype->getId()]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, ['label' => 'Delete'])
            ->getForm()
        ;
    }

    /**
     * Creates a form to edit a DemographicType entity.
     *
     * @param DemographicType $demographictype The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(DemographicType $demographictype = null)
    {
        if ($demographictype->getId()) {
            $form = $this->createForm(DemographicTypeType::class, $demographictype, [
                'action' => $this->generateUrl('demographictype', ['demographictype' => $demographictype->getId()]),
                'method' => 'PUT',
            ]);

            return $form;
        } else {
            $form = $this->createForm(DemographicTypeType::class, new DemographicType(), [
                'action' => $this->generateUrl('demographictype_new'),
                'method' => 'PUT',
            ]);

            return $form;
        }
    }
}
