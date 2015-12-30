<?php

namespace Lthrt\ContactBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Lthrt\ContactBundle\Entity\City;
use Lthrt\ContactBundle\Controller\ControllerTrait\CityFormController;

//
// City controller.
//
//

class CityController extends Controller
{
    use CityFormController;

    //
    // Creates a new City entity.
    //
    //
    public function createAction(Request $request)
    {
        $city = new City();
        $form = $this->createCreateForm($city);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();

            return $this->redirect($this->generateUrl('city_show', [ 'city' => $city->getId() ]));
        }

        return $this->render('LthrtContactBundle:City:new.html.twig', [
            'city' => $city,
            'form' => $form->createView(),
        ]);
    }

    //
    // Deletes a City entity.
    //
    //
    public function deleteAction(Request $request, City $city)
    {
        $form = $this->createDeleteForm($city);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if (!$city) {
                throw $this->createNotFoundException('Unable to find City entity.');
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($city);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('city'));
    }

    //
    // Displays a form to edit an existing City entity.
    //
    //
    public function editAction(Request $request, City $city)
    {
        if (!$city) {
            throw $this->createNotFoundException('Unable to find City entity.');
        }

        $form = $this->createEditForm($city);
        $deleteForm = $this->createDeleteForm($city);

        return $this->render('LthrtContactBundle:City:edit.html.twig', [
            'city' => $city,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    //
    // Lists all City entities.
    //
    //
    public function indexAction(Request $request)
    {
        $cityCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:City')->findAll();

        return $this->render('LthrtContactBundle:City:index.html.twig', [
            'cityCollection' => $cityCollection,
        ]);
    }


    //
    // Displays a form to create a new City entity.
    //
    //
    public function newAction(Request $request)
    {
        $city = new City();
        $form   = $this->createCreateForm($city);
    
        return $this->render('LthrtContactBundle:City:new.html.twig', [
            'city' => $city,
            'form'   => $form->createView(),
        ]);
    }


    //
    // Finds and displays a City entity.
    //
    //
    public function showAction(Request $request, City $city)
    {
        if (!$city) {
            throw $this->createNotFoundException('Unable to find City entity.');
        }

        $deleteForm = $this->createDeleteForm($city);

        return $this->render('LthrtContactBundle:City:show.html.twig', [
            'city' => $city,
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    //
    // Edits an existing City entity.
    //
    //
    public function updateAction(Request $request, City $city)
    {
        if (!$city) {
            throw $this->createNotFoundException('Unable to find City entity.');
        }

        $form = $this->createEditForm($city);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();

            return $this->redirect($this->generateUrl('city_show', [ 'city' => $city->getId() ]));
        }

        $deleteForm = $this->createDeleteForm($city);

        return $this->render('LthrtContactBundle:City:show.html.twig', [
            'city'      => $city,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

}
