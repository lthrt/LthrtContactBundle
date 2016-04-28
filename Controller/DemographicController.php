<?php

namespace Lthrt\ContactBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Lthrt\ContactBundle\Entity\Demographic;

/**
 * Demographic controller.
 *
 * @Route("/demographic")
 */

class DemographicController extends Controller
{
    use \Lthrt\ContactBundle\Traits\Controller\DemographicFormTrait;
    use \Lthrt\ContactBundle\Traits\Controller\DemographicNotFoundTrait;

    /**
     * Gets edit form existing Demographic entity.
     *
     * @Route("/{demographic}/edit", name="demographic_edit")
     * @Method({"GET"})
     * @Template("LthrtContactBundle:Demographic:edit.html.twig")
     */
    public function editAction(Request $request, Demographic $demographic)
    {
        $this->notFound($demographic);

        $form = $this->createEditForm($demographic);
        $deleteForm = $this->createDeleteForm($demographic);

         return [
            'demographic'      => $demographic,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

        /**
     * Lists all Demographic entities.
     *
     * @Route("/", name="demographic")
     * @Method("GET")
     * @Template("LthrtContactBundle:Demographic:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $demographicCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:Demographic')->findAll();

        return [
            'demographicCollection' => $demographicCollection,
        ];
    }

        /**
     * Routing for BackBone API for existing Demographic entity.
     * Handles show, update and delete
     *
     * @Route("/{demographic}", name="demographic_known", requirements={"demographic":"\d+"})
     * @Method({"DELETE","GET","PUT"})
     * @Template("LthrtContactBundle:Demographic:edit.html.twig")
     */
    public function knownAction(Request $request, Demographic $demographic)
    {
        $this->notFound($demographic);

        if ($request->isMethod('GET')) {  
            return $this->forward('LthrtContactBundle:Demographic:show', [ 'demographic' => $demographic, ]); 
        } else { // Method is PUT or DELETE
            $form = $this->createEditForm($demographic);
            $deleteForm = $this->createDeleteForm($demographic);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if ($request->isMethod('PUT')) {
                if ($form->isValid() && $form->isSubmitted()) {
                    $em->persist($demographic);
                    $em->flush();

                    return $this->forward('LthrtContactBundle:Demographic:show', [ 'demographic' => $demographic, ]);  
                } else {

                    return $this->render('LthrtContactBundle:Demographic:edit.html.twig', [
                        'demographic' => $demographic,
                        'form' => $form->createView(),
                        'delete_form' => $deleteForm->createView(),
                    ]);
                }
            } else {
                if ($request->isMethod('DELETE')){
                    if ($form->isValid() && $form->isSubmitted()) {
                        $em->remove($demographic);
                        $em->flush();

                        return $this->forward($this->generateUrl('demographic'));
                    } else {
                        return $this->forward('LthrtContactBundle:Demographic:show', [ 'demographic' => $demographic, ]); 
                    }
                }
            }
        }
    }
    
        /**
     * Creates a new Demographic entity.
     *
     * @Route("/new", name="demographic_new")
     * @Method({"GET", "POST"})
     * @Template("LthrtContactBundle:Demographic:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $demographic = new Demographic();
        $form = $this->createEditForm($demographic);
        $form->handleRequest($request);
        if (
            $request->isMethod('POST') && 
            $form->isValid() && 
            $form->isSubmitted()
        ) {        
            $em = $this->getDoctrine()->getManager();
            $em->persist($demographic);
            $em->flush();

            return $this->redirect($this->generateUrl('demographic_show', [ 'demographic' => $demographic->getId() ]));
        }

        return [
            'demographic' => $demographic,
            'form' => $form->createView(),
        ];
    }

        /**
     * Finds and displays a Demographic entity.
     *
     * @Route("/{demographic}/show", name="demographic_show")
     * @Method("GET")
     * @Template("LthrtContactBundle:Demographic:show.html.twig")
     */
    public function showAction(Request $request, Demographic $demographic)
    {
        $this->notFound($demographic);

        $deleteForm = $this->createDeleteForm($demographic);

        return [
            'demographic'      => $demographic,
            'delete_form' => $deleteForm->createView(),
        ];
    }

}
