<?php

namespace Lthrt\ContactBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Lthrt\ContactBundle\Entity\DemographicType;

/**
 * DemographicType controller.
 *
 * @Route("/demographictype")
 */

class DemographicTypeController extends Controller
{
    use \Lthrt\ContactBundle\Traits\Controller\DemographicTypeFormTrait;
    use \Lthrt\ContactBundle\Traits\Controller\DemographicTypeNotFoundTrait;

    /**
     * Gets edit form existing DemographicType entity.
     *
     * @Route("/{demographictype}/edit", name="demographictype_edit")
     * @Method({"GET"})
     * @Template("LthrtContactBundle:DemographicType:edit.html.twig")
     */
    public function editAction(Request $request, DemographicType $demographictype)
    {
        $this->notFound($demographictype);

        $form = $this->createEditForm($demographictype);
        $deleteForm = $this->createDeleteForm($demographictype);

        return $this->render('LthrtContactBundle:DemographicType:edit.html.twig', [
            'demographictype'      => $demographictype,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

        /**
     * Lists all DemographicType entities.
     *
     * @Route("/", name="demographictype")
     * @Method("GET")
     * @Template("LthrtContactBundle:DemographicType:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $demographictypeCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:DemographicType')->findAll();

        return [
            'demographictypeCollection' => $demographictypeCollection,
        ];
    }

        /**
     * Routing for BackBone API for existing DemographicType entity.
     * Handles show, update and delete
     *
     * @Route("/{demographictype}", name="demographictype_known")
     * @Method({"DELETE","GET","PUT"})
     * @Template("LthrtContactBundle:DemographicType:edit.html.twig")
     */
    public function knownAction(Request $request, DemographicType $demographictype)
    {
        $this->notFound($demographictype);

        if ($request->isMethod('GET')) {  
            return $this->forward('LthrtContactBundle:DemographicType:show', [ 'demographictype' => $demographictype, ]); 
        } else { // Method is PUT or DELETE
            $form = $this->createEditForm($demographictype);
            $deleteForm = $this->createDeleteForm($demographictype);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if ($request->isMethod('PUT')) {
                if ($form->isValid() && $form->isSubmitted()) {
                    $em->persist($demographictype);
                    $em->flush();

                    return $this->forward('LthrtContactBundle:DemographicType:show', [ 'demographictype' => $demographictype, ]);  
                } else {

                    return $this->render('LthrtContactBundle:DemographicType:edit.html.twig', [
                        'demographictype' => $demographictype,
                        'form' => $form->createView(),
                        'delete_form' => $deleteForm->createView(),
                    ]);
                }
            } else {
                if ($request->isMethod('DELETE')){
                    if ($form->isValid() && $form->isSubmitted()) {
                        $em->remove($demographictype);
                        $em->flush();

                        return $this->forward($this->generateUrl('demographictype'));
                    } else {
                        return $this->forward('LthrtContactBundle:DemographicType:show', [ 'demographictype' => $demographictype, ]); 
                    }
                }
            }
        }
    }
    
        /**
     * Creates a new DemographicType entity.
     *
     * @Route("/new", name="demographictype_new")
     * @Method({"GET", "POST"})
     * @Template("LthrtContactBundle:DemographicType:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $demographictype = new DemographicType();
        $form = $this->createEditForm($demographictype);
        $form->handleRequest($request);
        if (
            $request->isMethod('POST') && 
            $form->isValid() && 
            $form->isSubmitted()
        ) {        
            $em = $this->getDoctrine()->getManager();
            $em->persist($demographictype);
            $em->flush();

            return $this->redirect($this->generateUrl('demographictype_show', [ 'demographictype' => $demographictype->getId() ]));
        }

        return [
            'demographictype' => $demographictype,
            'form' => $form->createView(),
        ];
    }

        /**
     * Finds and displays a DemographicType entity.
     *
     * @Route("/{demographictype}/show", name="demographictype_show")
     * @Method("GET")
     * @Template("LthrtContactBundle:DemographicType:show.html.twig")
     */
    public function showAction(Request $request, DemographicType $demographictype)
    {
        $this->notFound($demographictype);

        $deleteForm = $this->createDeleteForm($demographictype);

        return [
            'demographictype'      => $demographictype,
            'delete_form' => $deleteForm->createView(),
        ];
    }

}
