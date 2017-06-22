<?php

namespace Lthrt\ContactBundle\Controller;

use Lthrt\ContactBundle\Entity\AddressType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * AddressType controller.
 *
 * @Route("/addresstype")
 */
class AddressTypeController extends Controller
{
    use \Lthrt\ContactBundle\Traits\Controller\AddressTypeFormTrait;
    use \Lthrt\ContactBundle\Traits\Controller\AddressTypeNotFoundTrait;

    /**
     * Gets edit form existing AddressType entity.
     *
     * @Route("/{addresstype}/edit", name="addresstype_edit", requirements={"addresstype":"\d+"})
     *
     * @Method({"GET"})
     * @Template("LthrtContactBundle:AddressType:edit.html.twig")
     */
    public function editAction(
        Request     $request,
        AddressType $addresstype
    ) {
        $this->ifNotFound($addresstype);

        $form       = $this->createEditForm($addresstype);
        $deleteForm = $this->createDeleteForm($addresstype);

        return [
            'addresstype' => $addresstype,
            'form'        => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Lists all AddressType entities.
     *
     * @Route("/", name="addresstype_list")
     *
     * @Method("GET")
     * @Template("LthrtContactBundle:AddressType:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $addresstypeCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:AddressType')->findAll();

        return [
            'addresstypeCollection' => $addresstypeCollection,
        ];
    }

    /**
     * Routing for BackBone API for existing AddressType entity.
     * Handles show, update and delete
     * action on a 'single' entity.
     *
     * @Route("/{addresstype}", name="addresstype", requirements={"addresstype":"\d+"})
     *
     * @Method({"DELETE","GET","PUT"})
     * @Template("LthrtContactBundle:AddressType:edit.html.twig")
     */
    public function singleAction(
        Request     $request,
        AddressType $addresstype
    ) {
        $this->ifNotFound($addresstype);

        if ($request->isMethod('GET')) {
            return $this->forward('LthrtContactBundle:AddressType:show', ['addresstype' => $addresstype]);
        } else {
            // Method is PUT or DELETE
            $form       = $this->createEditForm($addresstype);
            $deleteForm = $this->createDeleteForm($addresstype);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if ($request->isMethod('PUT')) {
                if ($form->isValid() && $form->isSubmitted()) {
                    $em->persist($addresstype);
                    $em->flush();

                    return $this->forward('LthrtContactBundle:AddressType:show', ['addresstype' => $addresstype]);
                } else {
                    return $this->render('LthrtContactBundle:AddressType:edit.html.twig', [
                        'addresstype' => $addresstype,
                        'form'        => $form->createView(),
                        'delete_form' => $deleteForm->createView(),
                    ]);
                }
            } else {
                if ($request->isMethod('DELETE')) {
                    if ($form->isValid() && $form->isSubmitted()) {
                        $em->remove($addresstype);
                        $em->flush();

                        return $this->forward($this->generateUrl('addresstype'));
                    } else {
                        return $this->forward('LthrtContactBundle:AddressType:show', ['addresstype' => $addresstype]);
                    }
                }
            }
        }
    }

    /**
     * Creates a new AddressType entity.
     *
     * @Route("/new", name="addresstype_new")
     *
     * @Method({"GET", "POST"})
     * @Template("LthrtContactBundle:AddressType:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $addresstype = new AddressType();
        $form        = $this->createEditForm($addresstype);
        $form->handleRequest($request);
        if (
            $request->isMethod('POST') &&
            $form->isValid() &&
            $form->isSubmitted()
        ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($addresstype);
            $em->flush();

            return $this->redirect($this->generateUrl('addresstype_show', ['addresstype' => $addresstype->getId()]));
        }

        return [
            'addresstype' => $addresstype,
            'form'        => $form->createView(),
        ];
    }

    /**
     * Finds and displays a AddressType entity.
     *
     * @Route("/{addresstype}/show", name="addresstype_show", requirements={"addresstype":"\d+"})
     *
     * @Method("GET")
     * @Template("LthrtContactBundle:AddressType:show.html.twig")
     */
    public function showAction(
        Request     $request,
        AddressType $addresstype
    ) {
        $this->ifNotFound($addresstype);

        $deleteForm = $this->createDeleteForm($addresstype);

        return [
            'addresstype' => $addresstype,
            'delete_form' => $deleteForm->createView(),
        ];
    }
}
