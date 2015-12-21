<?php

namespace Lthrt\ContactBundle\Controller;

use Lthrt\ContactBundle\Controller\ControllerTrait\DemographicFormController;
use Lthrt\ContactBundle\Entity\Demographic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//
// Demographic controller.
//
//

class DemographicController extends Controller
{
    use DemographicFormController;

    //
    // Creates a new Demographic entity.
    //
    //
    public function createAction(Request $request)
    {
        $demographic = new Demographic();
        $form        = $this->createCreateForm($demographic);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demographic);
            $em->flush();

            return $this->redirect($this->generateUrl('demographic_show', [ 'demographic' => $demographic->getId() ]));
        }

        return $this->render('LthrtContactBundle:Demographic:new.html.twig', [
            'demographic' => $demographic,
            'form'        => $form->createView(),
        ]);
    }

    //
    // Deletes a Demographic entity.
    //
    //
    public function deleteAction(Request $request, Demographic $demographic)
    {
        $form = $this->createDeleteForm($demographic);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if (!$demographic) {
                throw $this->createNotFoundException('Unable to find Demographic entity.');
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($demographic);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('demographic'));
    }

    //
    // Displays a form to edit an existing Demographic entity.
    //
    //
    public function editAction(Request $request, Demographic $demographic)
    {
        if (!$demographic) {
            throw $this->createNotFoundException('Unable to find Demographic entity.');
        }

        $form       = $this->createEditForm($demographic);
        $deleteForm = $this->createDeleteForm($demographic);

        return $this->render('LthrtContactBundle:Demographic:edit.html.twig', [
            'demographic' => $demographic,
            'form'        => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    //
    // Lists all Demographic entities.
    //
    //
    public function indexAction(Request $request)
    {
        $demographicCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:Demographic')->findAll();

        return $this->render('LthrtContactBundle:Demographic:index.html.twig', [
            'demographicCollection' => $demographicCollection,
        ]);
    }

    //
    // Displays a form to create a new Demographic entity.
    //
    //
    public function newAction(Request $request)
    {
        $demographic = new Demographic();
        $form        = $this->createCreateForm($demographic);

        return $this->render('LthrtContactBundle:Demographic:new.html.twig', [
            'demographic' => $demographic,
            'form'        => $form->createView(),
        ]);
    }

    //
    // Finds and displays a Demographic entity.
    //
    //
    public function showAction(Request $request, Demographic $demographic)
    {
        if (!$demographic) {
            throw $this->createNotFoundException('Unable to find Demographic entity.');
        }

        $deleteForm = $this->createDeleteForm($demographic);

        return $this->render('LthrtContactBundle:Demographic:show.html.twig', [
            'demographic' => $demographic,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    //
    // Edits an existing Demographic entity.
    //
    //
    public function updateAction(Request $request, Demographic $demographic)
    {
        if (!$demographic) {
            throw $this->createNotFoundException('Unable to find Demographic entity.');
        }

        $form = $this->createEditForm($demographic);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('demographic_show', [ 'demographic' => $demographic->getId() ]));
        }

        $deleteForm = $this->createDeleteForm($demographic);

        return $this->render('LthrtContactBundle:Demographic:show.html.twig', [
            'demographic'      => $demographic,
            'form'             => $form->createView(),
            'delete_form'      => $deleteForm->createView(),
        ]);
    }
}
