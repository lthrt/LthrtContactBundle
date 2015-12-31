<?php

namespace Lthrt\ContactBundle\Controller;

use Lthrt\ContactBundle\Controller\ControllerTrait\ContactFormController;
use Lthrt\ContactBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//
// Contact controller.
//
//

class ContactController extends Controller
{
    use ContactFormController;

    //
    // Creates a new Contact entity.
    //
    //
    public function createAction(Request $request)
    {
        $contact = new Contact();
        $form    = $this->createCreateForm($contact);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirect($this->generateUrl('contact_show', [ 'contact' => $contact->getId() ]));
        }

        return $this->render('LthrtContactBundle:Contact:new.html.twig', [
            'contact' => $contact,
            'form'    => $form->createView(),
        ]);
    }

    //
    // Deletes a Contact entity.
    //
    //
    public function deleteAction(Request $request, Contact $contact)
    {
        $form = $this->createDeleteForm($contact);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if (!$contact) {
                throw $this->createNotFoundException('Unable to find Contact entity.');
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($contact);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contact'));
    }

    //
    // Displays a form to edit an existing Contact entity.
    //
    //
    public function editAction(Request $request, Contact $contact)
    {
        if (!$contact) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $form       = $this->createEditForm($contact);
        $deleteForm = $this->createDeleteForm($contact);

        return $this->render('LthrtContactBundle:Contact:edit.html.twig', [
            'contact'     => $contact,
            'form'        => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    //
    // Lists all Contact entities.
    //
    //
    public function indexAction(Request $request)
    {
        $contactCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:Contact')->findAll();

        return $this->render('LthrtContactBundle:Contact:index.html.twig', [
            'contactCollection' => $contactCollection,
        ]);
    }

    //
    // Displays a form to create a new Contact entity.
    //
    //
    public function newAction(Request $request)
    {
        $contact = new Contact();
        $form    = $this->createCreateForm($contact);

        return $this->render('LthrtContactBundle:Contact:new.html.twig', [
            'contact' => $contact,
            'form'    => $form->createView(),
        ]);
    }

    //
    // Finds and displays a Contact entity.
    //
    //
    public function showAction(Request $request, Contact $contact)
    {
        if (!$contact) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $deleteForm = $this->createDeleteForm($contact);

        return $this->render('LthrtContactBundle:Contact:show.html.twig', [
            'contact'     => $contact,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    //
    // Edits an existing Contact entity.
    //
    //
    public function updateAction(Request $request, Contact $contact)
    {
        if (!$contact) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $form = $this->createEditForm($contact);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirect($this->generateUrl('contact_show', [ 'contact' => $contact->getId() ]));
        }

        $deleteForm = $this->createDeleteForm($contact);

        return $this->render('LthrtContactBundle:Contact:show.html.twig', [
            'contact'      => $contact,
            'form'         => $form->createView(),
            'delete_form'  => $deleteForm->createView(),
        ]);
    }
}
