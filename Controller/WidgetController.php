<?php

namespace Lthrt\ContactBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Widget controller.
 *
 * @Route("/widget")
 */
class WidgetController extends Controller
{
    /**
     * Gets edit form existing Address entity.
     *
     * @Route("/demographic/{type}", name="widget_guess")
     *
     * @Method({"GET"})
     */
    public function demographicAction(
        Request $request,
                $type
    ) {
        $count = $this->getDoctrine()
            ->getManager()
            ->getRepository('LthrtContactBundle:Person')
            ->getDemographicCountsCount($type);

        if ($count > 4) {
            return $this->render("LthrtContactBundle:Widget:demographicBar.html.twig", $this->getDemographicsResponse($type));
        } else {
            return $this->render("LthrtContactBundle:Widget:demographicPie.html.twig", $this->getDemographicsResponse($type));
        }
    }

    /**
     * Gets edit form existing Address entity.
     *
     * @Route("/demographicBar/{type}", name="widget_bar")
     *
     * @Method({"GET"})
     */
    public function demographicBarAction(
        Request $request,
                $type
    ) {
        $result = $this->getDoctrine()
            ->getManager()
            ->getRepository('LthrtContactBundle:Person')
            ->getDemographicCounts($type);

        return $this->render("LthrtContactBundle:Widget:demographicBar.html.twig", $this->getDemographicsResponse($type));
    }

    /**
     * Gets edit form existing Address entity.
     *
     * @Route("/demographicPie/{type}", name="widget_pie")
     *
     * @Method({"GET"})
     */
    public function demographicPieAction(
        Request $request,
                $type
    ) {
        $result = $this->getDoctrine()
            ->getManager()
            ->getRepository('LthrtContactBundle:Person')
            ->getDemographicCounts($type);

        return $this->render("LthrtContactBundle:Widget:demographicPie.html.twig", $this->getDemographicsResponse($type));
    }

    public function getDemographicsResponse($type)
    {
        $result = $this->getDoctrine()
            ->getManager()
            ->getRepository('LthrtContactBundle:Person')
            ->getDemographicCounts($type);

        $responseData = [
            'result' => $result,
            'type'   => $type,
        ];

        return $responseData;
    }
}
