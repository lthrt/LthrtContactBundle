<?php

namespace Lthrt\ContactBundle\Controller;

use Lthrt\ContactBundle\Controller\ControllerTrait\AddressTypeFormController;
use Lthrt\ContactBundle\Entity\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//
// AddressType controller.
//
//

class AddressTypeController extends Controller
{
    use AddressTypeFormController;

    //
    // Creates a new AddressType entity.
    //
    //
    public function createAction(Request $request)
    {
        $addresstype = new AddressType();
        $form        = $this->createCreateForm($addresstype);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($addresstype);
            $em->flush();

            return $this->redirect($this->generateUrl('addresstype_show', [ 'addresstype' => $addresstype->getId() ]));
        }

        return $this->render('LthrtContactBundle:AddressType:new.html.twig', [
            'addresstype' => $addresstype,
            'form'        => $form->createView(),
        ]);
    }

    //
    // Deletes a AddressType entity.
    //
    //
    public function deleteAction(Request $request, AddressType $addresstype)
    {
        $form = $this->createDeleteForm($addresstype);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if (!$addresstype) {
                throw $this->createNotFoundException('Unable to find AddressType entity.');
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($addresstype);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('addresstype'));
    }

    //
    // Displays a form to edit an existing AddressType entity.
    //
    //
    public function editAction(Request $request, AddressType $addresstype)
    {
        if (!$addresstype) {
            throw $this->createNotFoundException('Unable to find AddressType entity.');
        }

        $form       = $this->createEditForm($addresstype);
        $deleteForm = $this->createDeleteForm($addresstype);

        return $this->render('LthrtContactBundle:AddressType:edit.html.twig', [
            'addresstype' => $addresstype,
            'form'        => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    //
    // Lists all AddressType entities.
    //
    //
    public function indexAction(Request $request)
    {
        $addresstypeCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:AddressType')->findAll();

        return $this->render('LthrtContactBundle:AddressType:index.html.twig', [
            'addresstypeCollection' => $addresstypeCollection,
        ]);
    }

    //
    // Displays a form to create a new AddressType entity.
    //
    //
    public function newAction(Request $request)
    {
        $addresstype = new AddressType();
        $form        = $this->createCreateForm($addresstype);

        return $this->render('LthrtContactBundle:AddressType:new.html.twig', [
            'addresstype' => $addresstype,
            'form'        => $form->createView(),
        ]);
    }

    //
    // Finds and displays a AddressType entity.
    //
    //
    public function showAction(Request $request, AddressType $addresstype)
    {
        if (!$addresstype) {
            throw $this->createNotFoundException('Unable to find AddressType entity.');
        }

        $deleteForm = $this->createDeleteForm($addresstype);

        return $this->render('LthrtContactBundle:AddressType:show.html.twig', [
            'addresstype' => $addresstype,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    //
    // Edits an existing AddressType entity.
    //
    //
    public function updateAction(Request $request, AddressType $addresstype)
    {
        if (!$addresstype) {
            throw $this->createNotFoundException('Unable to find AddressType entity.');
        }

        $form = $this->createEditForm($addresstype);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($addresstype);
            $em->flush();

            return $this->redirect($this->generateUrl('addresstype_show', [ 'addresstype' => $addresstype->getId() ]));
        }

        $deleteForm = $this->createDeleteForm($addresstype);

        return $this->render('LthrtContactBundle:AddressType:show.html.twig', [
            'addresstype'      => $addresstype,
            'form'             => $form->createView(),
            'delete_form'      => $deleteForm->createView(),
        ]);
    }
}
