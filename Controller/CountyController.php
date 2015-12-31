<?php

namespace Lthrt\ContactBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Lthrt\ContactBundle\Entity\County;
use Lthrt\ContactBundle\Controller\ControllerTrait\CountyFormController;

//
// County controller.
//
//

class CountyController extends Controller
{
    use CountyFormController;

    //
    // Creates a new County entity.
    //
    //
    public function createAction(Request $request)
    {
        $county = new County();
        $form = $this->createCreateForm($county);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($county);
            $em->flush();

            return $this->redirect($this->generateUrl('county_show', [ 'county' => $county->getId() ]));
        }

        return $this->render('LthrtContactBundle:County:new.html.twig', [
            'county' => $county,
            'form' => $form->createView(),
        ]);
    }

    //
    // Deletes a County entity.
    //
    //
    public function deleteAction(Request $request, County $county)
    {
        $form = $this->createDeleteForm($county);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if (!$county) {
                throw $this->createNotFoundException('Unable to find County entity.');
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($county);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('county'));
    }

    //
    // Displays a form to edit an existing County entity.
    //
    //
    public function editAction(Request $request, County $county)
    {
        if (!$county) {
            throw $this->createNotFoundException('Unable to find County entity.');
        }

        $form = $this->createEditForm($county);
        $deleteForm = $this->createDeleteForm($county);

        return $this->render('LthrtContactBundle:County:edit.html.twig', [
            'county' => $county,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    //
    // Lists all County entities.
    //
    //
    public function indexAction(Request $request)
    {
        $countyCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:County')->findAll();

        return $this->render('LthrtContactBundle:County:index.html.twig', [
            'countyCollection' => $countyCollection,
        ]);
    }


    //
    // Displays a form to create a new County entity.
    //
    //
    public function newAction(Request $request)
    {
        $county = new County();
        $form   = $this->createCreateForm($county);
    
        return $this->render('LthrtContactBundle:County:new.html.twig', [
            'county' => $county,
            'form'   => $form->createView(),
        ]);
    }


    //
    // Finds and displays a County entity.
    //
    //
    public function showAction(Request $request, County $county)
    {
        if (!$county) {
            throw $this->createNotFoundException('Unable to find County entity.');
        }

        $deleteForm = $this->createDeleteForm($county);

        return $this->render('LthrtContactBundle:County:show.html.twig', [
            'county' => $county,
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    //
    // Edits an existing County entity.
    //
    //
    public function updateAction(Request $request, County $county)
    {
        if (!$county) {
            throw $this->createNotFoundException('Unable to find County entity.');
        }

        $form = $this->createEditForm($county);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($county);
            $em->flush();

            return $this->redirect($this->generateUrl('county_show', [ 'county' => $county->getId() ]));
        }

        $deleteForm = $this->createDeleteForm($county);

        return $this->render('LthrtContactBundle:County:show.html.twig', [
            'county'      => $county,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

}
