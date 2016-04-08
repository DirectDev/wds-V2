<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\EventType;
use Front\FrontBundle\Form\EventTypeType;

/**
 * EventType controller.
 *
 */
class EventTypeController extends Controller {


    public function listForEventSearchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findAll();

        return $this->render('FrontFrontBundle:EventType:listForEventSearch.html.twig', array(
                    'eventTypes' => $eventTypes,
        ));
    }

}
