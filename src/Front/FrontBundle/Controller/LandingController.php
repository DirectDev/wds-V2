<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class LandingController extends Controller {

    public function landingDancerAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('landing-dancer');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Landing:page.html.twig', array('page' => $page,));
    }

    public function landingProAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('landing-pro');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Landing:page.html.twig', array('page' => $page,));
    }

    public function landingPubAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('landing-pub');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Landing:page.html.twig', array('page' => $page,));
    }
    
    public function landingShareEventAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('landing-share-event');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Landing:page.html.twig', array('page' => $page,));
    }

}
