<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Search\SearchBundle\Form\UserFrontSearchType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Front\FrontBundle\Entity\City;
use Front\FrontBundle\Form\MusicTypeFrontFilterType;
use Front\FrontBundle\Form\EventTypeFrontFilterType;

class DefaultController extends Controller {

    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('home');
        if (!$page)
            throw new \Exception('Page not found!');

        $MeaCities = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaCity')->findForHomePage(9);
        $MeaFestivals = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaFestival')->findForHomePage(9);
        $MeaUsers = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForHomePage(9);


        return $this->render('FrontFrontBundle:Home:index.html.twig', array(
                    'page' => $page,
                    'MeaCities' => $MeaCities,
                    'MeaFestivals' => $MeaFestivals,
                    'MeaUsers' => $MeaUsers,
        ));
    }
    
    public function policyAction(Request $request) {

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('policy');
        if (!$page)
            throw new \Exception('Page not found!');

        return $this->render('FrontFrontBundle:Home:policy.html.twig', array(
                    'page' => $page,
        ));
    }

    public function footerAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $cities = $this->getDoctrine()->getRepository('FrontFrontBundle:City')->findAll();
        $eventTypeFestival = $this->getDoctrine()->getRepository('FrontFrontBundle:EventType')->findOneByName('Festival');
        $festivals = $this->getDoctrine()->getRepository('FrontFrontBundle:Event')->findForFooter(6, array($eventTypeFestival));
        $userTypeArtist = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('artist');
        $artists = $this->getDoctrine()->getRepository('UserUserBundle:User')->findForFooter(6, array($userTypeArtist));


        return $this->render('FrontFrontBundle::footer.html.twig', array(
                    'cities' => $cities,
                    'festivals' => $festivals,
                    'artists' => $artists,
        ));
    }

}
