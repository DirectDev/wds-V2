<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class LearnController extends Controller {

    public function learnSalsaAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('learn-salsa');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Learn:page.html.twig', array('page' => $page,));
    }

    public function learnBachataAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('learn-bachata');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Learn:page.html.twig', array('page' => $page,));
    }

    public function learnKizombaAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('learn-kizomba');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Learn:page.html.twig', array('page' => $page,));
    }

    public function learnMerengueAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('learn-merengue');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Learn:page.html.twig', array('page' => $page,));
    }

    public function learnTangoAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('learn-tango');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Learn:page.html.twig', array('page' => $page,));
    }

}
