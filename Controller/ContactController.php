<?php

namespace Lthrt\ContactBundle\Controller;

use Lthrt\ContactBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Contact controller.
 *
 * @Route("/contact")
 */

class ContactController extends Controller
{
    use \Lthrt\ContactBundle\Traits\Controller\ContactFormTrait;

    /**
     * Creates a new Contact entity.
     *
     * @Route("//update", name="contact_create")
     * @Method("POST")
     * @Template("LthrtContactBundle:Contact:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $contact = new Contact();
        $form    = $this->createEditForm($contact);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirect($this->generateUrl('contact_show', ['contact' => $contact->getId()]));
        }

        return [
            'contact' => $contact,
            'form'    => $form->createView(),
        ];
    }

    /**
     * Deletes a Contact entity.
     *
     * @Route("/{contact}/delete", name="contact_delete")
     * @Method("DELETE")
     */
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

    /**
     * Displays a form to edit an existing Contact entity.
     *
     * @Route("/{contact}/edit", name="contact_edit")
     * @Route("//edit", name="contact_new")
     * @Method("GET")
     * @Template("LthrtContactBundle:Contact:edit.html.twig")
     */
    public function editAction(Request $request, Contact $contact)
    {
        if (!$contact) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $form       = $this->createEditForm($contact);
        $deleteForm = $this->createDeleteForm($contact);

        return [
            'contact'     => $contact,
            'form'        => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Lists all Contact entities.
     *
     * @Route("/", name="contact")
     * @Method("GET")
     * @Template("LthrtContactBundle:Contact:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $contactCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:Contact')->findAll();

        return [
            'contactCollection' => $contactCollection,
        ];
    }

    /**
     * Displays a form to create a new Contact entity.
     *
     * @Route("/new", name="contact_new")
     * @Method("GET")
     * @Template("LthrtContactBundle:Contact:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $contact = new Contact();
        $form    = $this->createEditForm($contact);

        return [
            'contact' => $contact,
            'form'    => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Contact entity.
     *
     * @Route("/{contact}/show", name="contact_show")
     * @Method("GET")
     * @Template("LthrtContactBundle:Contact:show.html.twig")
     */
    public function showAction(Request $request, Contact $contact)
    {
        if (!$contact) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $deleteForm = $this->createDeleteForm($contact);

        return [
            'contact'     => $contact,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Edits an existing Contact entity.
     *
     * @Route("/{contact}/update", name="contact_update")
     * @Method("PUT")
     * @Template("LthrtContactBundle:Contact:edit.html.twig")
     */
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

            return $this->redirect($this->generateUrl('contact_show', ['contact' => $contact->getId()]));
        }

        $deleteForm = $this->createDeleteForm($contact);

        return [
            'contact'     => $contact,
            'form'        => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

}
