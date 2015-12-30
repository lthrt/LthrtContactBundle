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
        if ($state) { $options['state'] = $state; }
        if ($county) { $options['county'] = $county; }
        $form = $this->createCountyStateForm($options);

        return $this->render('LthrtContactBundle:CountyState:form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
