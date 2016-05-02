<?php

namespace Lthrt\ContactBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Lthrt\ContactBundle\Entity\State;

/**
 * State controller.
 *
 * @Route("/state")
 */

class StateController extends Controller
{
    use \Lthrt\ContactBundle\Traits\Controller\StateFormTrait;
    use \Lthrt\ContactBundle\Traits\Controller\StateNotFoundTrait;

    /**
     * Gets edit form existing State entity.
     *
     * @Route("/{state}/edit", name="state_edit")
     * @Method({"GET"})
     * @Template("LthrtContactBundle:State:edit.html.twig")
     */
    public function editAction(Request $request, State $state)
    {
        $this->notFound($state);

        $form = $this->createEditForm($state);
        $deleteForm = $this->createDeleteForm($state);

         return [
            'state'      => $state,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

        /**
     * Lists all State entities.
     *
     * @Route("/", name="state_list")
     * @Method("GET")
     * @Template("LthrtContactBundle:State:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $stateCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:State')->findAll();

        return [
            'stateCollection' => $stateCollection,
        ];
    }

        /**
     * Routing for BackBone API for existing State entity.
     * Handles show, update and delete
     * action on a 'single' entity
     *
     * @Route("/{state}", name="state", requirements={"state":"\d+"})
     * @Method({"DELETE","GET","PUT"})
     * @Template("LthrtContactBundle:State:edit.html.twig")
     */
    public function singleAction(Request $request, State $state)
    {
        $this->notFound($state);

        if ($request->isMethod('GET')) {  
            return $this->forward('LthrtContactBundle:State:show', [ 'state' => $state, ]); 
        } else { // Method is PUT or DELETE
            $form = $this->createEditForm($state);
            $deleteForm = $this->createDeleteForm($state);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if ($request->isMethod('PUT')) {
                if ($form->isValid() && $form->isSubmitted()) {
                    $em->persist($state);
                    $em->flush();

                    return $this->forward('LthrtContactBundle:State:show', [ 'state' => $state, ]);  
                } else {

                    return $this->render('LthrtContactBundle:State:edit.html.twig', [
                        'state' => $state,
                        'form' => $form->createView(),
                        'delete_form' => $deleteForm->createView(),
                    ]);
                }
            } else {
                if ($request->isMethod('DELETE')){
                    if ($form->isValid() && $form->isSubmitted()) {
                        $em->remove($state);
                        $em->flush();

                        return $this->forward($this->generateUrl('state'));
                    } else {
                        return $this->forward('LthrtContactBundle:State:show', [ 'state' => $state, ]); 
                    }
                }
            }
        }
    }
    
        /**
     * Creates a new State entity.
     *
     * @Route("/new", name="state_new")
     * @Method({"GET", "POST"})
     * @Template("LthrtContactBundle:State:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $state = new State();
        $form = $this->createEditForm($state);
        $form->handleRequest($request);
        if (
            $request->isMethod('POST') && 
            $form->isValid() && 
            $form->isSubmitted()
        ) {        
            $em = $this->getDoctrine()->getManager();
            $em->persist($state);
            $em->flush();

            return $this->redirect($this->generateUrl('state_show', [ 'state' => $state->getId() ]));
        }

        return [
            'state' => $state,
            'form' => $form->createView(),
        ];
    }

        /**
     * Finds and displays a State entity.
     *
     * @Route("/{state}/show", name="state_show")
     * @Method("GET")
     * @Template("LthrtContactBundle:State:show.html.twig")
     */
    public function showAction(Request $request, State $state)
    {
        $this->notFound($state);

        $deleteForm = $this->createDeleteForm($state);

        return [
            'state'      => $state,
            'delete_form' => $deleteForm->createView(),
        ];
    }

}
