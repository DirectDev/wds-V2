<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\Tag;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tag controller.
 *
 */
class TagController extends Controller {

    public function listForVideoSearchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('FrontFrontBundle:Tag')->findAll();

        return $this->render('FrontFrontBundle:Tag:listForVideoSearch.html.twig', array(
                    'tags' => $tags,
        ));
    }

    public function listForMusicSearchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('FrontFrontBundle:Tag')->findAll();

        return $this->render('FrontFrontBundle:Tag:listForMusicSearch.html.twig', array(
                    'tags' => $tags,
        ));
    }

}
