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
use Front\FrontBundle\Form\UserFilterType;

class DefaultController extends Controller {

    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('home');
        if (!$page)
            throw new \Exception('Page not found!');

        $MeaCities = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaCity')->findForHomePage(8);
        $MeaFestivals = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaFestival')->findForHomePage(8);
        $MeaUsers = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForHomePage(8);


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

        $cities = $this->getDoctrine()->getRepository('FrontFrontBundle:City')->findForFooter(6);
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

        return $this->render('FrontFrontBundle:Navbar:navbar.html.twig', array(
                    'masterRequest' => $masterRequest,
        ));
    }

    public function navbarDiscoverAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $MeaUsersSalsaDiscover = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForSalsaDiscover(1);
        $MeaUsersBachataDiscover = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForBachataDiscover(2);
        $MeaUsersKizombaDiscover = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForKizombaDiscover(3);
        $MeaCitiesDiscover = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaCity')->findForDiscover(5);

        return $this->render('FrontFrontBundle:Navbar:navbar_discover.html.twig', array(
                    'MeaUsersSalsaDiscover' => $MeaUsersSalsaDiscover,
                    'MeaUsersBachataDiscover' => $MeaUsersBachataDiscover,
                    'MeaUsersKizombaDiscover' => $MeaUsersKizombaDiscover,
                    'MeaCitiesDiscover' => $MeaCitiesDiscover,
        ));
    }

    public function navbarLearnAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $MeaUsersSalsaLearn = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForSalsaLearn(2);
        $MeaUsersBachataLearn = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForBachataLearn(2);
        $MeaUsersKizombaLearn = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForKizombaLearn(2);
        $MeaCitiesLearn = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaCity')->findForLearn(4);

        return $this->render('FrontFrontBundle:Navbar:navbar_learn.html.twig', array(
                    'MeaUsersSalsaLearn' => $MeaUsersSalsaLearn,
                    'MeaUsersBachataLearn' => $MeaUsersBachataLearn,
                    'MeaUsersKizombaLearn' => $MeaUsersKizombaLearn,
                    'MeaCitiesLearn' => $MeaCitiesLearn,
        ));
    }

    public function navbarMeetAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $MeaUsersSalsaMeet = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForSalsaMeet(2);
        $MeaUsersBachataMeet = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForBachataMeet(2);
        $MeaUsersKizombaMeet = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForKizombaMeet(2);
//        $MeaCitiesMeet = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaCity')->findForMeet(4);
        $filterForm = $this->createFilterUserForm();

        return $this->render('FrontFrontBundle:Navbar:navbar_meet.html.twig', array(
                    'MeaUsersSalsaMeet' => $MeaUsersSalsaMeet,
                    'MeaUsersBachataMeet' => $MeaUsersBachataMeet,
                    'MeaUsersKizombaMeet' => $MeaUsersKizombaMeet,
//                    'MeaCitiesMeet' => $MeaCitiesMeet,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    private function createFilterUserForm() {
        $form = $this->createForm(new UserFilterType(), null, array(
            'action' => $this->generateUrl('front_user_filter'),
            'method' => 'GET',
        ));

        return $form;
    }
    
    public function sitemapAction(Request $request) {

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('sitemap');
        if (!$page)
            throw new \Exception('Page not found!');
        
        $em = $this->getDoctrine()->getManager();
        
        $locales = $this->getParameter('locales');

        $cities = $this->getDoctrine()->getRepository('FrontFrontBundle:City')->findByFooter(1);

        return $this->render('FrontFrontBundle:Home:sitemap.html.twig', array(
                    'page' => $page,
                    'cities' => $cities,
                    'locales' => $locales,
        ));
    }

}
