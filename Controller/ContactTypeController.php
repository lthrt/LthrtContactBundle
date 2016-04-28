<?php

namespace Lthrt\ContactBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Lthrt\ContactBundle\Entity\ContactType;

/**
 * ContactType controller.
 *
 * @Route("/contacttype")
 */

class ContactTypeController extends Controller
{
    use \Lthrt\ContactBundle\Traits\Controller\ContactTypeFormTrait;
    use \Lthrt\ContactBundle\Traits\Controller\ContactTypeNotFoundTrait;

    /**
     * Gets edit form existing ContactType entity.
     *
     * @Route("/{contacttype}/edit", name="contacttype_edit")
     * @Method({"GET"})
     * @Template("LthrtContactBundle:ContactType:edit.html.twig")
     */
    public function editAction(Request $request, ContactType $contacttype)
    {
        $this->notFound($contacttype);

        $form = $this->createEditForm($contacttype);
        $deleteForm = $this->createDeleteForm($contacttype);

         return [
            'contacttype'      => $contacttype,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

        /**
     * Lists all ContactType entities.
     *
     * @Route("/", name="contacttype")
     * @Method("GET")
     * @Template("LthrtContactBundle:ContactType:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $contacttypeCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:ContactType')->findAll();

        return [
            'contacttypeCollection' => $contacttypeCollection,
        ];
    }

        /**
     * Routing for BackBone API for existing ContactType entity.
     * Handles show, update and delete
     *
     * @Route("/{contacttype}", name="contacttype_known", requirements={"contacttype":"\d+"})
     * @Method({"DELETE","GET","PUT"})
     * @Template("LthrtContactBundle:ContactType:edit.html.twig")
     */
    public function knownAction(Request $request, ContactType $contacttype)
    {
        $this->notFound($contacttype);

        if ($request->isMethod('GET')) {  
            return $this->forward('LthrtContactBundle:ContactType:show', [ 'contacttype' => $contacttype, ]); 
        } else { // Method is PUT or DELETE
            $form = $this->createEditForm($contacttype);
            $deleteForm = $this->createDeleteForm($contacttype);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if ($request->isMethod('PUT')) {
                if ($form->isValid() && $form->isSubmitted()) {
                    $em->persist($contacttype);
                    $em->flush();

                    return $this->forward('LthrtContactBundle:ContactType:show', [ 'contacttype' => $contacttype, ]);  
                } else {

                    return $this->render('LthrtContactBundle:ContactType:edit.html.twig', [
                        'contacttype' => $contacttype,
                        'form' => $form->createView(),
                        'delete_form' => $deleteForm->createView(),
                    ]);
                }
            } else {
                if ($request->isMethod('DELETE')){
                    if ($form->isValid() && $form->isSubmitted()) {
                        $em->remove($contacttype);
                        $em->flush();

                        return $this->forward($this->generateUrl('contacttype'));
                    } else {
                        return $this->forward('LthrtContactBundle:ContactType:show', [ 'contacttype' => $contacttype, ]); 
                    }
                }
            }
        }
    }
    
        /**
     * Creates a new ContactType entity.
     *
     * @Route("/new", name="contacttype_new")
     * @Method({"GET", "POST"})
     * @Template("LthrtContactBundle:ContactType:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $contacttype = new ContactType();
        $form = $this->createEditForm($contacttype);
        $form->handleRequest($request);
        if (
            $request->isMethod('POST') && 
            $form->isValid() && 
            $form->isSubmitted()
        ) {        
            $em = $this->getDoctrine()->getManager();
            $em->persist($contacttype);
            $em->flush();

            return $this->redirect($this->generateUrl('contacttype_show', [ 'contacttype' => $contacttype->getId() ]));
        }

        return [
            'contacttype' => $contacttype,
            'form' => $form->createView(),
        ];
    }

        /**
     * Finds and displays a ContactType entity.
     *
     * @Route("/{contacttype}/show", name="contacttype_show")
     * @Method("GET")
     * @Template("LthrtContactBundle:ContactType:show.html.twig")
     */
    public function showAction(Request $request, ContactType $contacttype)
    {
        $this->notFound($contacttype);

        $deleteForm = $this->createDeleteForm($contacttype);

        return [
            'contacttype'      => $contacttype,
            'delete_form' => $deleteForm->createView(),
        ];
    }

}
