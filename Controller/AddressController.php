<?php

namespace Lthrt\ContactBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Lthrt\ContactBundle\Entity\Address;
use Lthrt\ContactBundle\Controller\ControllerTrait\AddressFormController;

//
// Address controller.
//
//

class AddressController extends Controller
{
    use AddressFormController;

    //
    // Creates a new Address entity.
    //
    //
    public function createAction(Request $request)
    {
        $address = new Address();
        $form = $this->createCreateForm($address);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            return $this->redirect($this->generateUrl('address_show', [ 'address' => $address->getId() ]));
        }

        return $this->render('LthrtContactBundle:Address:new.html.twig', [
            'address' => $address,
            'form' => $form->createView(),
        ]);
    }

    //
    // Deletes a Address entity.
    //
    //
    public function deleteAction(Request $request, Address $address)
    {
        $form = $this->createDeleteForm($address);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if (!$address) {
                throw $this->createNotFoundException('Unable to find Address entity.');
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($address);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('address'));
    }

    //
    // Displays a form to edit an existing Address entity.
    //
    //
    public function editAction(Request $request, Address $address)
    {
        if (!$address) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        $form = $this->createEditForm($address);
        $deleteForm = $this->createDeleteForm($address);

        return $this->render('LthrtContactBundle:Address:edit.html.twig', [
            'address' => $address,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    //
    // Lists all Address entities.
    //
    //
    public function indexAction(Request $request)
    {
        $addressCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:Address')->findAll();

        return $this->render('LthrtContactBundle:Address:index.html.twig', [
            'addressCollection' => $addressCollection,
        ]);
    }


    //
    // Displays a form to create a new Address entity.
    //
    //
    public function newAction(Request $request)
    {
        $address = new Address();
        $form   = $this->createCreateForm($address);
    
        return $this->render('LthrtContactBundle:Address:new.html.twig', [
            'address' => $address,
            'form'   => $form->createView(),
        ]);
    }


    //
    // Finds and displays a Address entity.
    //
    //
    public function showAction(Request $request, Address $address)
    {
        if (!$address) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        $deleteForm = $this->createDeleteForm($address);

        return $this->render('LthrtContactBundle:Address:show.html.twig', [
            'address' => $address,
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    //
    // Edits an existing Address entity.
    //
    //
    public function updateAction(Request $request, Address $address)
    {
        if (!$address) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        $form = $this->createEditForm($address);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            return $this->redirect($this->generateUrl('address_show', [ 'address' => $address->getId() ]));
        }

        $deleteForm = $this->createDeleteForm($address);

        return $this->render('LthrtContactBundle:Address:show.html.twig', [
            'address'      => $address,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

}
