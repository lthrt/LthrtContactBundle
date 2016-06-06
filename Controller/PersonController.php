<?php

namespace Lthrt\ContactBundle\Controller;

use Lthrt\ContactBundle\Entity\Person;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Person controller.
 *
 * @Route("/person")
 */
class PersonController extends Controller
{
    use \Lthrt\ContactBundle\Traits\Controller\PersonFormTrait;
    use \Lthrt\ContactBundle\Traits\Controller\PersonNotFoundTrait;

    /**
     * Gets edit form existing Person entity.
     *
     * @Route("/{person}/edit", name="person_edit")
     *
     * @Method({"GET"})
     * @Template("LthrtContactBundle:Person:edit.html.twig")
     */
    public function editAction(Request $request, Person $person)
    {
        $this->notFound($person);

        $form       = $this->createEditForm($person);
        $deleteForm = $this->createDeleteForm($person);

        return [
            'person'      => $person,
            'form'        => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Lists all Person entities.
     *
     * @Route("/", name="person_list")
     *
     * @Method("GET")
     * @Template("LthrtContactBundle:Person:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $personCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:Person')->findAll();

        return [
            'personCollection' => $personCollection,
        ];
    }

    /**
     * Routing for BackBone API for existing Person entity.
     * Handles show, update and delete
     * action on a 'single' entity.
     *
     * @Route("/{person}", name="person", requirements={"person":"\d+"})
     *
     * @Method({"DELETE","GET","PUT"})
     * @Template("LthrtContactBundle:Person:edit.html.twig")
     */
    public function singleAction(Request $request, Person $person)
    {
        $this->notFound($person);

        if ($request->isMethod('GET')) {
            return $this->forward('LthrtContactBundle:Person:show', [ 'person' => $person]);
        } else { // Method is PUT or DELETE
            $form       = $this->createEditForm($person);
            $deleteForm = $this->createDeleteForm($person);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if ($request->isMethod('PUT')) {
                if ($form->isValid() && $form->isSubmitted()) {
                    $em->persist($person);
                    $em->flush();

                    return $this->forward('LthrtContactBundle:Person:show', [ 'person' => $person]);
                } else {
                    return $this->render('LthrtContactBundle:Person:edit.html.twig', [
                        'person'      => $person,
                        'form'        => $form->createView(),
                        'delete_form' => $deleteForm->createView(),
                    ]);
                }
            } else {
                if ($request->isMethod('DELETE')) {
                    if ($form->isValid() && $form->isSubmitted()) {
                        $em->remove($person);
                        $em->flush();

                        return $this->forward($this->generateUrl('person'));
                    } else {
                        return $this->forward('LthrtContactBundle:Person:show', [ 'person' => $person]);
                    }
                }
            }
        }
    }

    /**
     * Creates a new Person entity.
     *
     * @Route("/new", name="person_new")
     *
     * @Method({"GET", "POST"})
     * @Template("LthrtContactBundle:Person:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $person = new Person();
        $form   = $this->createEditForm($person);
        $form->handleRequest($request);
        if (
            $request->isMethod('POST') &&
            $form->isValid() &&
            $form->isSubmitted()
        ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            return $this->redirect($this->generateUrl('person_show', [ 'person' => $person->getId() ]));
        }

        return [
            'person' => $person,
            'form'   => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Person entity.
     *
     * @Route("/{person}/show", name="person_show")
     *
     * @Method("GET")
     * @Template("LthrtContactBundle:Person:show.html.twig")
     */
    public function showAction(Request $request, Person $person)
    {
        $this->notFound($person);

        $deleteForm = $this->createDeleteForm($person);

        return [
            'person'      => $person,
            'delete_form' => $deleteForm->createView(),
        ];
    }
}
