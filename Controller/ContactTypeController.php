<?php

namespace Lthrt\ContactBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Lthrt\ContactBundle\Entity\ContactType;
use Lthrt\ContactBundle\Controller\ControllerTrait\ContactTypeFormController;

//
// ContactType controller.
//
//

class ContactTypeController extends Controller
{
    use ContactTypeFormController;

    //
    // Creates a new ContactType entity.
    //
    //
    public function createAction(Request $request)
    {
        $contacttype = new ContactType();
        $form = $this->createCreateForm($contacttype);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contacttype);
            $em->flush();

            return $this->redirect($this->generateUrl('contacttype_show', [ 'contacttype' => $contacttype->getId() ]));
        }

        return $this->render('LthrtContactBundle:ContactType:new.html.twig', [
            'contacttype' => $contacttype,
            'form' => $form->createView(),
        ]);
    }

    //
    // Deletes a ContactType entity.
    //
    //
    public function deleteAction(Request $request, ContactType $contacttype)
    {
        $form = $this->createDeleteForm($contacttype);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if (!$contacttype) {
                throw $this->createNotFoundException('Unable to find ContactType entity.');
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($contacttype);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contacttype'));
    }

    //
    // Displays a form to edit an existing ContactType entity.
    //
    //
    public function editAction(Request $request, ContactType $contacttype)
    {
        if (!$contacttype) {
            throw $this->createNotFoundException('Unable to find ContactType entity.');
        }

        $form = $this->createEditForm($contacttype);
        $deleteForm = $this->createDeleteForm($contacttype);

        return $this->render('LthrtContactBundle:ContactType:edit.html.twig', [
            'contacttype' => $contacttype,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    //
    // Lists all ContactType entities.
    //
    //
    public function indexAction(Request $request)
    {
        $contacttypeCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:ContactType')->findAll();

        return $this->render('LthrtContactBundle:ContactType:index.html.twig', [
            'contacttypeCollection' => $contacttypeCollection,
        ]);
    }


    //
    // Displays a form to create a new ContactType entity.
    //
    //
    public function newAction(Request $request)
    {
        $contacttype = new ContactType();
        $form   = $this->createCreateForm($contacttype);
    
        return $this->render('LthrtContactBundle:ContactType:new.html.twig', [
            'contacttype' => $contacttype,
            'form'   => $form->createView(),
        ]);
    }


    //
    // Finds and displays a ContactType entity.
    //
    //
    public function showAction(Request $request, ContactType $contacttype)
    {
        if (!$contacttype) {
            throw $this->createNotFoundException('Unable to find ContactType entity.');
        }

        $deleteForm = $this->createDeleteForm($contacttype);

        return $this->render('LthrtContactBundle:ContactType:show.html.twig', [
            'contacttype' => $contacttype,
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    //
    // Edits an existing ContactType entity.
    //
    //
    public function updateAction(Request $request, ContactType $contacttype)
    {
        if (!$contacttype) {
            throw $this->createNotFoundException('Unable to find ContactType entity.');
        }

        $form = $this->createEditForm($contacttype);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contacttype);
            $em->flush();

            return $this->redirect($this->generateUrl('contacttype_show', [ 'contacttype' => $contacttype->getId() ]));
        }

        $deleteForm = $this->createDeleteForm($contacttype);

        return $this->render('LthrtContactBundle:ContactType:show.html.twig', [
            'contacttype'      => $contacttype,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

}
