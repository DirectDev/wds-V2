<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\MusicType;
use Front\FrontBundle\Form\MusicTypeType;

/**
 * MusicType controller.
 *
 */
class MusicTypeController extends Controller {

    public function filtersAction() {
        $em = $this->getDoctrine()->getManager();

        $musicTypes = $em->getRepository('FrontFrontBundle:MusicType')->findAll();

        return $this->render('FrontFrontBundle:MusicType:filters.html.twig', array(
                    'musicTypes' => $musicTypes,
        ));
    }

    public function listForUserSearchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $musicTypes = $em->getRepository('FrontFrontBundle:MusicType')->findAll();

        return $this->render('FrontFrontBundle:MusicType:listForUserSearch.html.twig', array(
                    'musicTypes' => $musicTypes,
        ));
    }

    public function listForEventSearchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $musicTypes = $em->getRepository('FrontFrontBundle:MusicType')->findAll();

        return $this->render('FrontFrontBundle:MusicType:listForEventSearch.html.twig', array(
                    'musicTypes' => $musicTypes,
        ));
    }

}
