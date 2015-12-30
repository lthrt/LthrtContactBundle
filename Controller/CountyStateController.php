<?php

namespace Lthrt\ContactBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Lthrt\ContactBundle\Entity\County;
use Lthrt\ContactBundle\Entity\State;
use Lthrt\ContactBundle\Controller\ControllerTrait\CountyStateFormController;

//
// County controller.
//
//

class CountyStateController extends Controller
{
    use CountyStateFormController;

    public function formAction(Request $request, County $county = null, State $state = null)
    {
        $options = [];


        if ($request->request->get('state')) {
                $state = $this->getDoctrine()->getManager()
                ->getRepository('LthrtContactBundle:State')
                ->findOneById(intval($request->request->get('state')))
                ;
        }

        if ($state) { $options['state'] = $state; }
        if ($county) { $options['county'] = $county; }

// var_dump($data);
var_dump($request->request->get('state'));

        if ($state) {
            $options['action'] = $this->generateUrl('county_by_state_form', ['state' => $state]);
        } elseif ($county) {
            $options['action'] = $this->generateUrl('state_by_county_form', ['county' => $county]);
        } else {
            $options['action'] = $this->generateUrl('county_state_form');
        }


        $form = $this->createCountyStateForm($options);

        $form->handleRequest($request);
        return $this->render('LthrtContactBundle:CountyState:form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
