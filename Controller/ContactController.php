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
    use \Lthrt\ContactBundle\Traits\Controller\ContactNotFoundTrait;

    /**
     * Gets edit form existing Contact entity.
     *
     * @Route("/{contact}/edit", name="contact_edit", requirements={"contact":"\d+"})
     *
     * @Method({"GET"})
     * @Template("LthrtContactBundle:Contact:edit.html.twig")
     */
    public function editAction(
        Request $request,
        Contact $contact
    ) {
        $this->ifNotFound($contact);

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
     * @Route("/", name="contact_list")
     *
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
     * Routing for BackBone API for existing Contact entity.
     * Handles show, update and delete
     * action on a 'single' entity.
     *
     * @Route("/{contact}", name="contact", requirements={"contact":"\d+"})
     *
     * @Method({"DELETE","GET","PUT"})
     * @Template("LthrtContactBundle:Contact:edit.html.twig")
     */
    public function singleAction(
        Request $request,
        Contact $contact
    ) {
        $this->ifNotFound($contact);

        if ($request->isMethod('GET')) {
            return $this->forward('LthrtContactBundle:Contact:show', ['contact' => $contact]);
        } else {
            // Method is PUT or DELETE
            $form       = $this->createEditForm($contact);
            $deleteForm = $this->createDeleteForm($contact);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if ($request->isMethod('PUT')) {
                if ($form->isValid() && $form->isSubmitted()) {
                    $em->persist($contact);
                    $em->flush();

                    return $this->forward('LthrtContactBundle:Contact:show', ['contact' => $contact]);
                } else {
                    return $this->render('LthrtContactBundle:Contact:edit.html.twig', [
                        'contact'     => $contact,
                        'form'        => $form->createView(),
                        'delete_form' => $deleteForm->createView(),
                    ]);
                }
            } else {
                if ($request->isMethod('DELETE')) {
                    if ($form->isValid() && $form->isSubmitted()) {
                        $em->remove($contact);
                        $em->flush();

                        return $this->forward($this->generateUrl('contact'));
                    } else {
                        return $this->forward('LthrtContactBundle:Contact:show', ['contact' => $contact]);
                    }
                }
            }
        }
    }

    /**
     * Creates a new Contact entity.
     *
     * @Route("/new", name="contact_new")
     *
     * @Method({"GET", "POST"})
     * @Template("LthrtContactBundle:Contact:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $contact = new Contact();
        $form    = $this->createEditForm($contact);
        $form->handleRequest($request);
        if (
            $request->isMethod('POST') &&
            $form->isValid() &&
            $form->isSubmitted()
        ) {
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
     * Finds and displays a Contact entity.
     *
     * @Route("/{contact}/show", name="contact_show", requirements={"contact":"\d+"})
     *
     * @Method("GET")
     * @Template("LthrtContactBundle:Contact:show.html.twig")
     */
    public function showAction(
        Request $request,
        Contact $contact
    ) {
        $this->ifNotFound($contact);

        $deleteForm = $this->createDeleteForm($contact);

        return [
            'contact'     => $contact,
            'delete_form' => $deleteForm->createView(),
        ];
    }
}
