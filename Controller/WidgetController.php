<?php

namespace Lthrt\ContactBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
     * @Route("/demographic/{type}", name="widget_demo")
     *
     * @Method({"GET"})
     * @Template("LthrtContactBundle:Widget:demographic.html.twig")
     */
    public function demographicPieAction(
        Request $request,
                $type
    ) {
        $result = $this->getDoctrine()
            ->getManager()
            ->getRepository('LthrtContactBundle:Person')
            ->getDemographicCounts($type);

        return [
            'result' => $result,
            'type'   => $type,
        ];
    }
}
