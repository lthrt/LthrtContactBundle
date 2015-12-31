<?php

namespace Lthrt\ContactBundle\Controller;

use Lthrt\ContactBundle\Controller\ControllerTrait\StateFormController;
use Lthrt\ContactBundle\Entity\State;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//
// State controller.
//
//

class StateController extends Controller
{
    use StateFormController;

    //
    // Creates a new State entity.
    //
    //
    public function createAction(Request $request)
    {
        $state = new State();
        $form  = $this->createCreateForm($state);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($state);
            $em->flush();

            return $this->redirect($this->generateUrl('state_show', [ 'state' => $state->getId() ]));
        }

        return $this->render('LthrtContactBundle:State:new.html.twig', [
            'state' => $state,
            'form'  => $form->createView(),
        ]);
    }

    //
    // Deletes a State entity.
    //
    //
    public function deleteAction(Request $request, State $state)
    {
        $form = $this->createDeleteForm($state);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if (!$state) {
                throw $this->createNotFoundException('Unable to find State entity.');
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($state);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('state'));
    }

    //
    // Displays a form to edit an existing State entity.
    //
    //
    public function editAction(Request $request, State $state)
    {
        if (!$state) {
            throw $this->createNotFoundException('Unable to find State entity.');
        }

        $form       = $this->createEditForm($state);
        $deleteForm = $this->createDeleteForm($state);

        return $this->render('LthrtContactBundle:State:edit.html.twig', [
            'state'       => $state,
            'form'        => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    //
    // Lists all State entities.
    //
    //
    public function indexAction(Request $request)
    {
        $stateCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:State')->findAll();

        return $this->render('LthrtContactBundle:State:index.html.twig', [
            'stateCollection' => $stateCollection,
        ]);
    }

    //
    // Displays a form to create a new State entity.
    //
    //
    public function newAction(Request $request)
    {
        $state  = new State();
        $form   = $this->createCreateForm($state);

        return $this->render('LthrtContactBundle:State:new.html.twig', [
            'state'  => $state,
            'form'   => $form->createView(),
        ]);
    }

    //
    // Finds and displays a State entity.
    //
    //
    public function showAction(Request $request, State $state)
    {
        if (!$state) {
            throw $this->createNotFoundException('Unable to find State entity.');
        }

        $deleteForm = $this->createDeleteForm($state);

        return $this->render('LthrtContactBundle:State:show.html.twig', [
            'state'       => $state,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    //
    // Edits an existing State entity.
    //
    //
    public function updateAction(Request $request, State $state)
    {
        if (!$state) {
            throw $this->createNotFoundException('Unable to find State entity.');
        }

        $form = $this->createEditForm($state);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($state);
            $em->flush();

            return $this->redirect($this->generateUrl('state_show', [ 'state' => $state->getId() ]));
        }

        $deleteForm = $this->createDeleteForm($state);

        return $this->render('LthrtContactBundle:State:show.html.twig', [
            'state'       => $state,
            'form'        => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }
}
