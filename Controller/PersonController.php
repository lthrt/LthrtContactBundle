<?php

namespace Lthrt\ContactBundle\Controller;

use Lthrt\ContactBundle\Controller\ControllerTrait\PersonFormController;
use Lthrt\ContactBundle\Entity\Person;
use Lthrt\EntityBundle\Model\EntityLogger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//
// Person controller.
//
//

class PersonController extends Controller
{
    use PersonFormController;

    //
    // Creates a new Person entity.
    //
    //
    public function createAction(Request $request)
    {
        $person = new Person();
        $form   = $this->createCreateForm($person);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            return $this->redirect($this->generateUrl('person_show', ['person' => $person->getId()]));
        }

        return $this->render('LthrtContactBundle:Person:new.html.twig', [
            'person' => $person,
            'form'   => $form->createView(),
        ]);
    }

    //
    // Deletes a Person entity.
    //
    //
    public function deleteAction(
        Request $request,
        Person  $person
    ) {
        $form = $this->createDeleteForm($person);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if (!$person) {
                throw $this->createNotFoundException('Unable to find Person entity.');
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($person);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('person'));
    }

    //
    // Displays a form to edit an existing Person entity.
    //
    //
    public function editAction(
        Request $request,
        Person  $person
    ) {
        if (!$person) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }

        $form       = $this->createEditForm($person);
        $deleteForm = $this->createDeleteForm($person);

        return $this->render('LthrtContactBundle:Person:edit.html.twig', [
            'person'      => $person,
            'form'        => $form->createView(),
            'submit'      => $this->createSubmitform('Update')->createView(),
            'delete_form' => $deleteForm->createView(),

        ]);
    }

    //
    // Lists all Person entities.
    //
    //
    public function indexAction(Request $request)
    {
        $personCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:Person')->findAll();

        return $this->render('LthrtContactBundle:Person:index.html.twig', [
            'personCollection' => $personCollection,
        ]);
    }

    //
    // Displays a form to create a new Person entity.
    //
    //
    public function newAction(Request $request)
    {
        $person = new Person();
        $form   = $this->createCreateForm($person);

        return $this->render('LthrtContactBundle:Person:new.html.twig', [
            'person' => $person,
            'form'   => $form->createView(),
        ]);
    }

    //
    // Finds and displays a Person entity.
    //
    //
    public function showAction(
        Request $request,
        Person  $person
    ) {
        if (!$person) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }

        $logger = new EntityLogger($this->getDoctrine()->getManager());
        $log    = $logger->findLog($person);

        $deleteForm = $this->createDeleteForm($person);

        return $this->render('LthrtContactBundle:Person:show.html.twig', [
            'person'      => $person,
            'log'         => $log,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    //
    // Edits an existing Person entity.
    //
    //
    public function updateAction(
        Request $request,
        Person  $person
    ) {
        if (!$person) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }

        $form = $this->createEditForm($person);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            return $this->redirect($this->generateUrl('person_show', ['person' => $person->getId()]));
        }

        $deleteForm = $this->createDeleteForm($person);

        return $this->render('LthrtContactBundle:Person:show.html.twig', [
            'person'      => $person,
            'form'        => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }
}
