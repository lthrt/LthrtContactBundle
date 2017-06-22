<?php

namespace Lthrt\ContactBundle\Controller;

use Lthrt\ContactBundle\Entity\Address;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Address controller.
 *
 * @Route("/address")
 */
class AddressController extends Controller
{
    use \Lthrt\ContactBundle\Traits\Controller\AddressFormTrait;
    use \Lthrt\ContactBundle\Traits\Controller\AddressNotFoundTrait;

    /**
     * Gets edit form existing Address entity.
     *
     * @Route("/{address}/edit", name="address_edit", requirements={"address":"\d+"})
     *
     * @Method({"GET"})
     * @Template("LthrtContactBundle:Address:edit.html.twig")
     */
    public function editAction(
        Request $request,
        Address $address
    ) {
        $this->ifNotFound($address);

        $form       = $this->createEditForm($address);
        $deleteForm = $this->createDeleteForm($address);

        return [
            'address'     => $address,
            'form'        => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Lists all Address entities.
     *
     * @Route("/", name="address_list")
     *
     * @Method("GET")
     * @Template("LthrtContactBundle:Address:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $addressCollection = $this->getDoctrine()->getManager()->getRepository('LthrtContactBundle:Address')->findAll();

        return [
            'addressCollection' => $addressCollection,
        ];
    }

    /**
     * Routing for BackBone API for existing Address entity.
     * Handles show, update and delete
     * action on a 'single' entity.
     *
     * @Route("/{address}", name="address", requirements={"address":"\d+"})
     *
     * @Method({"DELETE","GET","PUT"})
     * @Template("LthrtContactBundle:Address:edit.html.twig")
     */
    public function singleAction(
        Request $request,
        Address $address
    ) {
        $this->ifNotFound($address);

        if ($request->isMethod('GET')) {
            return $this->forward('LthrtContactBundle:Address:show', ['address' => $address]);
        } else {
            // Method is PUT or DELETE
            $form       = $this->createEditForm($address);
            $deleteForm = $this->createDeleteForm($address);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            if ($request->isMethod('PUT')) {
                if ($form->isValid() && $form->isSubmitted()) {
                    $em->persist($address);
                    $em->flush();

                    return $this->forward('LthrtContactBundle:Address:show', ['address' => $address]);
                } else {
                    return $this->render('LthrtContactBundle:Address:edit.html.twig', [
                        'address'     => $address,
                        'form'        => $form->createView(),
                        'delete_form' => $deleteForm->createView(),
                    ]);
                }
            } else {
                if ($request->isMethod('DELETE')) {
                    if ($form->isValid() && $form->isSubmitted()) {
                        $em->remove($address);
                        $em->flush();

                        return $this->forward($this->generateUrl('address'));
                    } else {
                        return $this->forward('LthrtContactBundle:Address:show', ['address' => $address]);
                    }
                }
            }
        }
    }

    /**
     * Creates a new Address entity.
     *
     * @Route("/new", name="address_new")
     *
     * @Method({"GET", "POST"})
     * @Template("LthrtContactBundle:Address:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $address = new Address();
        $form    = $this->createEditForm($address);
        $form->handleRequest($request);
        if (
            $request->isMethod('POST') &&
            $form->isValid() &&
            $form->isSubmitted()
        ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            return $this->redirect($this->generateUrl('address_show', ['address' => $address->getId()]));
        }

        return [
            'address' => $address,
            'form'    => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Address entity.
     *
     * @Route("/{address}/show", name="address_show", requirements={"address":"\d+"})
     *
     * @Method("GET")
     * @Template("LthrtContactBundle:Address:show.html.twig")
     */
    public function showAction(
        Request $request,
        Address $address
    ) {
        $this->ifNotFound($address);

        $deleteForm = $this->createDeleteForm($address);

        return [
            'address'     => $address,
            'delete_form' => $deleteForm->createView(),
        ];
    }
}
