<?php

namespace Lthrt\ContactBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Dashboard controller.
 *
 * @Route("/dashboard")
 */
class DashboardController extends Controller
{
    use \Lthrt\ContactBundle\Traits\Controller\PersonFormTrait;
    use \Lthrt\ContactBundle\Traits\Controller\PersonNotFoundTrait;

    /**
     * Gets the dashboard
     *
     * @Route("/", name="dashboard")
     *
     * @Method("GET")
     *
     */
    public function indexAction(Request $request)
    {
        $personCollection = $this->getDoctrine()
            ->getManager()
            ->getRepository('LthrtContactBundle:Person')
            ->findBy([], ['firstName' => 'ASC']);

        return $this->render("LthrtContactBundle:Dashboard:dashboard.html.twig",
            [
                'personCollection' => $personCollection,
            ]
        );
    }
}
