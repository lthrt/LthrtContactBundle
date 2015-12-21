<?php

namespace Lthrt\ContactBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Lthrt\ContactBundle\Entity\Zip;
use Lthrt\ContactBundle\Controller\ControllerTrait\ZipFormController;

//
// Zip controller.
//
//

class ZipController extends Controller
{
    use ZipFormController;

    //
    // Creates a new Zip entity.
    //
    //
    public function createAction(Request $request)
    {
        $zip = new Zip();
        $form = $this->createCreateForm($zip);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($zip);
            $em->flush();

            return $this->redirect($this->generateUrl('zip_show', [ 'zip' => $zip->getId() ]));
        }

        return $this->render('LthrtContactBundle:Zip:new.html.twig', [
            'zip' => $zip,
            'form' => $form->createView(),
        ]);
    }

    //
    // Deletes a Zip entity.
    //
    //
    public function deleteAction(Request $request, Zip $zip)
    {
        $form = $this->createDeleteForm($zip);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if (!$zip) {
                throw $this->createNotFoundException('Unable to find Zip entity.');
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($zip);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('zip'));
    }

    //
    // Displays a form to edit an existing Zip entity.
    //
    //
    public function editAction(Request $request, Zip $zip)
    {
        if (!$zip) {
            throw $this->createNotFoundException('Unable to find Zip entity.');
        }

        $form = $this->createEditForm($zip);
        $deleteForm = $this->createDeleteForm($zip);

        return $this->render('LthrtContactBundle:Zip:edit.html.twig', [
            'zip' => $zip,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    //
    // Lists all Zip entities.
    //
    //
    public function indexAction(Request $request)
    {
        $zipCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:Zip')->findAll();

        return $this->render('LthrtContactBundle:Zip:index.html.twig', [
            'zipCollection' => $zipCollection,
        ]);
    }


    //
    // Displays a form to create a new Zip entity.
    //
    //
    public function newAction(Request $request)
    {
        $zip = new Zip();
        $form   = $this->createCreateForm($zip);
    
        return $this->render('LthrtContactBundle:Zip:new.html.twig', [
            'zip' => $zip,
            'form'   => $form->createView(),
        ]);
    }


    //
    // Finds and displays a Zip entity.
    //
    //
    public function showAction(Request $request, Zip $zip)
    {
        if (!$zip) {
            throw $this->createNotFoundException('Unable to find Zip entity.');
        }

        $deleteForm = $this->createDeleteForm($zip);

        return $this->render('LthrtContactBundle:Zip:show.html.twig', [
            'zip' => $zip,
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    //
    // Edits an existing Zip entity.
    //
    //
    public function updateAction(Request $request, Zip $zip)
    {
        if (!$zip) {
            throw $this->createNotFoundException('Unable to find Zip entity.');
        }

        $form = $this->createEditForm($zip);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($zip);
            $em->flush();

            return $this->redirect($this->generateUrl('zip_show', [ 'zip' => $zip->getId() ]));
        }

        $deleteForm = $this->createDeleteForm($zip);

        return $this->render('LthrtContactBundle:Zip:show.html.twig', [
            'zip'      => $zip,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

}
