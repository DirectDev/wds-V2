<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class DanceController extends Controller {

    public function danceSalsaAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('dance-salsa');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Dance:page.html.twig', array('page' => $page,));
    }

    public function danceSalsaCubanaAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('dance-salsa-cubana');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Dance:page.html.twig', array('page' => $page,));
    }

    public function danceSalsaOn1Action(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('dance-salsa-on1');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Dance:page.html.twig', array('page' => $page,));
    }

    public function danceSalsaOn2Action(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('dance-salsa-on2');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Dance:page.html.twig', array('page' => $page,));
    }

    public function danceSalsaDominicanaAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('dance-salsa-dominicana');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Dance:page.html.twig', array('page' => $page,));
    }

    public function danceSalsaRuedaAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('dance-salsa-rueda');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Dance:page.html.twig', array('page' => $page,));
    }

    public function danceBachataAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('dance-bachata');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Dance:page.html.twig', array('page' => $page,));
    }

    public function danceBachataModernaAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('dance-bachata-moderna');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Dance:page.html.twig', array('page' => $page,));
    }

    public function danceBachataDominicanaAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('dance-bachata-dominicana');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Dance:page.html.twig', array('page' => $page,));
    }

    public function danceBachataSensualAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('dance-bachata-sensual');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Dance:page.html.twig', array('page' => $page,));
    }

    public function danceKizombaAction(Request $request) {
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('dance-kizomba');
        if (!$page)
            throw new \Exception('Page not found!');
        return $this->render('FrontFrontBundle:Dance:page.html.twig', array('page' => $page,));
    }

}
