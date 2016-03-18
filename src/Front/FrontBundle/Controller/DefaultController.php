<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
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

    public function navbarAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        
        $stack = $this->get('request_stack');
        $masterRequest = $stack->getMasterRequest();
          
        $MeaUsersSalsaDiscover = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForSalsaDiscover(1);
        $MeaUsersBachataDiscover = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForBachataDiscover(2);
        $MeaUsersKizombaDiscover = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForKizombaDiscover(3);
        $MeaCitiesDiscover = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaCity')->findForDiscover(5);
       
        $MeaUsersSalsaLearn = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForSalsaLearn(2);
        $MeaUsersBachataLearn = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForBachataLearn(2);
        $MeaUsersKizombaLearn = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForKizombaLearn(2);
        $MeaCitiesLearn = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaCity')->findForLearn(4);
        
        $MeaUsersSalsaMeet = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForSalsaMeet(2);
        $MeaUsersBachataMeet = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForBachataMeet(2);
        $MeaUsersKizombaMeet = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForKizombaMeet(2);
        $MeaCitiesMeet = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaCity')->findForMeet(4);
       

        return $this->render('FrontFrontBundle:Navbar:navbar.html.twig', array(     
                    'masterRequest' => $masterRequest,
            
                    'MeaUsersSalsaDiscover' => $MeaUsersSalsaDiscover,
                    'MeaUsersBachataDiscover' => $MeaUsersBachataDiscover,
                    'MeaUsersKizombaDiscover' => $MeaUsersKizombaDiscover,
                    'MeaCitiesDiscover' => $MeaCitiesDiscover,
            
                    'MeaUsersSalsaLearn' => $MeaUsersSalsaLearn,
                    'MeaUsersBachataLearn' => $MeaUsersBachataLearn,
                    'MeaUsersKizombaLearn' => $MeaUsersKizombaLearn,
                    'MeaCitiesLearn' => $MeaCitiesLearn,
            
                    'MeaUsersSalsaMeet' => $MeaUsersSalsaMeet,
                    'MeaUsersBachataMeet' => $MeaUsersBachataMeet,
                    'MeaUsersKizombaMeet' => $MeaUsersKizombaMeet,
                    'MeaCitiesMeet' => $MeaCitiesMeet,
        ));
    }

}
