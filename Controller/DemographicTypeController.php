<?php

namespace Lthrt\ContactBundle\Controller;

use Lthrt\ContactBundle\Controller\ControllerTrait\DemographicTypeFormController;
use Lthrt\ContactBundle\Entity\DemographicType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//
// DemographicType controller.
//
//

class DemographicTypeController extends Controller
{
    use DemographicTypeFormController;

    //
    // Creates a new DemographicType entity.
    //
    //
    public function createAction(Request $request)
    {
        $demographictype = new DemographicType();
        $form            = $this->createCreateForm($demographictype);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demographictype);
            $em->flush();

            return $this->redirect($this->generateUrl('demographictype_show', [ 'demographictype' => $demographictype->getId() ]));
        }

        return $this->render('LthrtContactBundle:DemographicType:new.html.twig', [
            'demographictype' => $demographictype,
            'form'            => $form->createView(),
        ]);
    }

    //
    // Deletes a DemographicType entity.
    //
    //
    public function deleteAction(Request $request, DemographicType $demographictype)
    {
        $form = $this->createDeleteForm($demographictype);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if (!$demographictype) {
                throw $this->createNotFoundException('Unable to find DemographicType entity.');
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($demographictype);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('demographictype'));
    }

    //
    // Displays a form to edit an existing DemographicType entity.
    //
    //
    public function editAction(Request $request, DemographicType $demographictype)
    {
        if (!$demographictype) {
            throw $this->createNotFoundException('Unable to find DemographicType entity.');
        }

        $form       = $this->createEditForm($demographictype);
        $deleteForm = $this->createDeleteForm($demographictype);

        return $this->render('LthrtContactBundle:DemographicType:edit.html.twig', [
            'demographictype' => $demographictype,
            'form'            => $form->createView(),
            'delete_form'     => $deleteForm->createView(),
        ]);
    }

    //
    // Lists all DemographicType entities.
    //
    //
    public function indexAction(Request $request)
    {
        $demographictypeCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:DemographicType')->findAll();

        return $this->render('LthrtContactBundle:DemographicType:index.html.twig', [
            'demographictypeCollection' => $demographictypeCollection,
        ]);
    }

    //
    // Displays a form to create a new DemographicType entity.
    //
    //
    public function newAction(Request $request)
    {
        $demographictype = new DemographicType();
        $form            = $this->createCreateForm($demographictype);

        return $this->render('LthrtContactBundle:DemographicType:new.html.twig', [
            'demographictype' => $demographictype,
            'form'            => $form->createView(),
        ]);
    }

    //
    // Finds and displays a DemographicType entity.
    //
    //
    public function showAction(Request $request, DemographicType $demographictype)
    {
        if (!$demographictype) {
            throw $this->createNotFoundException('Unable to find DemographicType entity.');
        }

        $deleteForm = $this->createDeleteForm($demographictype);

        return $this->render('LthrtContactBundle:DemographicType:show.html.twig', [
            'demographictype' => $demographictype,
            'delete_form'     => $deleteForm->createView(),
        ]);
    }

    //
    // Edits an existing DemographicType entity.
    //
    //
    public function updateAction(Request $request, DemographicType $demographictype)
    {
        if (!$demographictype) {
            throw $this->createNotFoundException('Unable to find DemographicType entity.');
        }

        $form = $this->createEditForm($demographictype);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demographictype);
            $em->flush();

            return $this->redirect($this->generateUrl('demographictype_show', [ 'demographictype' => $demographictype->getId() ]));
        }

        $deleteForm = $this->createDeleteForm($demographictype);

        return $this->render('LthrtContactBundle:DemographicType:show.html.twig', [
            'demographictype'      => $demographictype,
            'form'                 => $form->createView(),
            'delete_form'          => $deleteForm->createView(),
        ]);
    }
}
