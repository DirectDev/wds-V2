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
//
//    private $max_results = 6;
//    private $add_days = 'P8D';

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('home');
        if (!$page)
            throw new \Exception('Page not found!');

        $MeaCities = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaCity')->findForHomePage();
        $MeaFestivals = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaFestival')->findForHomePage();
        $MeaUsers = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaUser')->findForHomePage();


        return $this->render('FrontFrontBundle:Home:index.html.twig', array(
                    'page' => $page,
                    'MeaCities' => $MeaCities,
                    'MeaFestivals' => $MeaFestivals,
                    'MeaUsers' => $MeaUsers,
        ));

//        try {
//        // bug reponse de free_geo_ip trop longue
//        // curl set timeout non defini -> CurlAdapter
//            $geoIp = $this->container
//                    ->get('bazinga_geocoder.geocoder')
//                    ->using('free_geo_ip')
//                    ->geocode($request->server->get('REMOTE_ADDR'));
//
//            $latitude = $geoIp['latitude'];
//            $longitude = $geoIp['longitude'];
//            $city = $geoIp['city'];
//        } catch (\Exception $e) {
//            
//        }
//
//        if (!isset($city)){
//            $city= 'Lille, France';
//            $latitude = 50.62925;
//            $longitude = 3.057256;
//        }
//        
//        $session->set('city', $city);
//        $session->set('latitude', $latitude);
//        $session->set('longitude', $longitude);
//
//        $startdate = date('Y-m-d');
//        $tomorrowDateTime = new \DateTime($startdate);
//        $tomorrowDateTime->add(new \DateInterval('P1D'));
//        $tomorrow = $tomorrowDateTime->format('Y-m-d');
//        $stopDateTime = new \DateTime($startdate);
//        $stopDateTime->add(new \DateInterval($this->add_days));
//        $stopdate = $stopDateTime->format('Y-m-d');
//        $session->set('startdate', $startdate);
//        $session->set('tomorrow', $tomorrow);
//        $session->set('stopdate', $stopdate);
//
//        $musicTypes = $em->getRepository('FrontFrontBundle:MusicType')->findById($session->get('musicTypes'));
//        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findById($session->get('eventTypes'));
//
//
//        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, $musicTypes, $startdate, $tomorrow, $latitude, $longitude);
//        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, $musicTypes, $tomorrow, $stopdate, $latitude, $longitude, null, $events);
//
//        $musicTypeFrontFilterForm = $this->container->get('form.factory')->create(new MusicTypeFrontFilterType());
//        $eventTypeFrontFilterForm = $this->container->get('form.factory')->create(new EventTypeFrontFilterType());
//
//        $user = $this->getDoctrine()->getRepository('UserUserBundle:User')->find(1);
//
//        return $this->render('FrontFrontBundle:Home:index.html.twig', array(
//                    'page' => $page,
//                    'user' => $user,
//                    'events' => $events,
//                    'nextEvents' => $nextEvents,
//                    'startdate' => $startdate,
//                    'musicTypeFrontFilterForm' => $musicTypeFrontFilterForm->createView(),
//                    'eventTypeFrontFilterForm' => $eventTypeFrontFilterForm->createView()
//        ));
    }

//    public function calendarAction(Request $request) {
//
//        $em = $this->getDoctrine()->getManager();
//        $session = $this->getRequest()->getSession();
//
//        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('calendar');
//        if (!$page)
//            throw new \Exception('Page not found!');
//        $searchcity = $request->get('searchcity', '', true);
//        if (!$searchcity)
//            $searchcity = $session->get('city');
//
//        if (!$searchcity)
//            return new response('', 404);
//
//        $city = $em->getRepository('FrontFrontBundle:City')->findOneBy(array('searchcity' => $searchcity));
//
//        if (isset($city) && $city) {
//            $session->set('latitude', $city->getLatitude());
//            $session->set('longitude', $city->getLongitude());
//            $session->set('city', $city->getSearchcity());
//        } else {
//
//            $city = new City();
//            $city->setSearchcity(trim(strtolower($searchcity)));
//
//            try {
//                $this->setLatitudeAndLongitude($city);
//                $em->persist($city);
//                $em->flush();
//
//                $session = $this->getRequest()->getSession();
//                $session->set('latitude', $city->getLatitude());
//                $session->set('longitude', $city->getLongitude());
//                $session->set('city', $city->getSearchcity());
//            } catch (\Exception $e) {
//                
//            }
//        }
//        $city = $this->getCity($request);
//        $this->setDates($request);
//
//        $musicTypes = $em->getRepository('FrontFrontBundle:MusicType')->findById($session->get('musicTypes'));
//        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findById($session->get('eventTypes'));
//
//        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, $musicTypes, $this->startdate, $this->tomorrow, $city->getLatitude(), $city->getLongitude());
//        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, $musicTypes, $this->tomorrow, $this->stopdate, $city->getLatitude(), $city->getLongitude(), null, $events);
//
//        $musicTypeFrontFilterForm = $this->container->get('form.factory')->create(new MusicTypeFrontFilterType());
//        $eventTypeFrontFilterForm = $this->container->get('form.factory')->create(new EventTypeFrontFilterType());
//
//        $user = $this->getDoctrine()->getRepository('UserUserBundle:User')->find(1);
//
//        return $this->render('FrontFrontBundle:Home:calendar.html.twig', array(
//                    'page' => $page,
//                    'user' => $user,
//                    'events' => $events,
//                    'nextEvents' => $nextEvents,
//                    'startdate' => $startdate,
//                    'musicTypeFrontFilterForm' => $musicTypeFrontFilterForm->createView(),
//                    'eventTypeFrontFilterForm' => $eventTypeFrontFilterForm->createView()
//        ));
//    }
//
//    private function getEvents($em, $startdate_only = true, $limit = 6, $eventTypes = null, $musicTypes = null, $startdate = null, $stopdate = null, $latitude = null, $longitude = null, $distance = 20, $excludedEvents = array()) {
//
//        $events = $em->getRepository('FrontFrontBundle:Event')
//                ->findForHomepage($startdate_only, $limit, $eventTypes, $musicTypes, $startdate, $stopdate, $latitude, $longitude, 20, $excludedEvents);
//
//        return $events;
//    }
//    private function setLatitudeAndLongitude($city) {
//        try {
//            $geocode = $this->container
//                    ->get('bazinga_geocoder.geocoder')
//                    ->using('google_maps')
//                    ->geocode($city->getSearchcity());
//
//            $city->setLatitude($geocode['latitude']);
//            $city->setLongitude($geocode['longitude']);
//        } catch (\Exception $e) {
//            throw $e;
//        }
//    }
//
//    public function filterListByMusicTypeAction(Request $request) {
//
//        $session = $this->getRequest()->getSession();
//        $em = $this->getDoctrine()->getManager();
//
//        $ids = $request->request->get('front_front_bundle_musictypefrontfilter[name]', '', true);
//
//        $musicTypes = $em->getRepository('FrontFrontBundle:MusicType')->findById($ids);
//        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findById($session->get('eventTypes'));
//
//
//        $session = $this->getRequest()->getSession();
//        $session->set('musicTypes', $ids);
//
//        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, $musicTypes, $session->get('startdate'), $session->get('tomorrow'), $session->get('latitude'), $session->get('longitude'));
//        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, $musicTypes, $session->get('tomorrow'), $session->get('stopdate'), $session->get('latitude'), $session->get('longitude'), null, $events);
//
//        return $this->render('FrontFrontBundle:Home:list.html.twig', array(
//                    'events' => $events,
//                    'nextEvents' => $nextEvents,
//        ));
//    }
//
//    public function filterMapByMusicTypeAction(Request $request) {
//
//        $session = $this->getRequest()->getSession();
//        $em = $this->getDoctrine()->getManager();
//
//        $ids = $request->request->get('front_front_bundle_musictypefrontfilter[name]', '', true);
//
//        $musicTypes = $em->getRepository('FrontFrontBundle:MusicType')->findById($ids);
//        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findById($session->get('eventTypes'));
//
//        $session = $this->getRequest()->getSession();
//        $session->set('musicTypes', $ids);
//
//        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, $musicTypes, $session->get('startdate'), $session->get('tomorrow'), $session->get('latitude'), $session->get('longitude'));
//        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, $musicTypes, $session->get('tomorrow'), $session->get('stopdate'), $session->get('latitude'), $session->get('longitude'), null, $events);
//
//        return $this->render('FrontFrontBundle:Home:map.html.twig', array(
//                    'events' => $events,
//                    'nextEvents' => $nextEvents,
//        ));
//    }
//
//    public function filterListByEventTypeAction(Request $request) {
//
//        $session = $this->getRequest()->getSession();
//        $em = $this->getDoctrine()->getManager();
//
//        $ids = $request->request->get('front_front_bundle_eventtypefrontfilter[name]', '', true);
//
//        $musicTypes = $em->getRepository('FrontFrontBundle:MusicType')->findById($session->get('musicTypes'));
//        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findById($ids);
//
//
//        $session = $this->getRequest()->getSession();
//        $session->set('eventTypes', $ids);
//
//        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, $musicTypes, $session->get('startdate'), $session->get('tomorrow'), $session->get('latitude'), $session->get('longitude'));
//        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, $musicTypes, $session->get('tomorrow'), $session->get('stopdate'), $session->get('latitude'), $session->get('longitude'), null, $events);
//
//
//        return $this->render('FrontFrontBundle:Home:list.html.twig', array(
//                    'events' => $events,
//                    'nextEvents' => $nextEvents,
//        ));
//    }
//
//    public function filterMapByEventTypeAction(Request $request) {
//
//        $session = $this->getRequest()->getSession();
//        $em = $this->getDoctrine()->getManager();
//
//        $ids = $request->request->get('front_front_bundle_eventtypefrontfilter[name]', '', true);
//
//        $musicTypes = $em->getRepository('FrontFrontBundle:MusicType')->findById($session->get('musicTypes'));
//        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findById($ids);
//
//        $session = $this->getRequest()->getSession();
//        $session->set('eventTypes', $ids);
//
//        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, $musicTypes, $session->get('startdate'), $session->get('tomorrow'), $session->get('latitude'), $session->get('longitude'));
//        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, $musicTypes, $session->get('tomorrow'), $session->get('stopdate'), $session->get('latitude'), $session->get('longitude'), null, $events);
//
//        return $this->render('FrontFrontBundle:Home:map.html.twig', array(
//                    'events' => $events,
//                    'nextEvents' => $nextEvents,
//        ));
//    }

    public function policyAction(Request $request) {

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('policy');
        if (!$page)
            throw new \Exception('Page not found!');

        return $this->render('FrontFrontBundle:Home:policy.html.twig', array(
                    'page' => $page,
        ));
    }

//    public function cityAction(Request $request) {  
//
//        $em = $this->getDoctrine()->getManager();
//        $session = $this->getRequest()->getSession();
//        $startdate = date('Y-m-d');
//
//        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city');
//        if (!$page)
//            throw new \Exception('Page not found!');
//        
//        $city = $this->getCity($request);
//
//        $user = $this->getDoctrine()->getRepository('UserUserBundle:User')->find(1);
//        
//        $people = $this->getUsers($em, 200, $city->getLatitude(), $city->getLongitude());
//        $places = array();
//        
//        $eventTypeIntroductions = $em->getRepository('FrontFrontBundle:EventType')->findById(array(4));
//        $eventTypeWorkshops = $em->getRepository('FrontFrontBundle:EventType')->findById(array(3,7));
//        $eventTypeConcerts = $em->getRepository('FrontFrontBundle:EventType')->findById(array(6));
//        $eventTypeFestivals = $em->getRepository('FrontFrontBundle:EventType')->findById(array(2));
//        
//        $introductions = $em->getRepository('FrontFrontBundle:Event')
//                ->findForCitypage(6, $eventTypeIntroductions, $startdate, $session->get('stopdate'), $city->getLatitude(), $city->getLongitude(), 20);
//        $workshops = $em->getRepository('FrontFrontBundle:Event')
//                ->findForCitypage(6, $eventTypeWorkshops, $startdate, $session->get('stopdate'), $city->getLatitude(), $city->getLongitude(), 20);
//        
//        $next2month = new \DateTime($startdate);
//        $next2month->add(new \DateInterval('P2M'));
//        
//        $concerts = $em->getRepository('FrontFrontBundle:Event')
//                ->findForCitypage(6, $eventTypeConcerts, $startdate, $next2month, $city->getLatitude(), $city->getLongitude(), 20);
//        
//        $nextyear = new \DateTime($startdate);
//        $nextyear->add(new \DateInterval('P1Y'));
//        
//        $festivals = $em->getRepository('FrontFrontBundle:Event')
//                ->findForCitypage(6, $eventTypeFestivals, $startdate, $nextyear, $city->getLatitude(), $city->getLongitude(), 20);
//
//        
//        $photos = $this->getPhotos($em, 6, $city->getLatitude(), $city->getLongitude());
//        $musics = array();
//        $videos = array();
//
//        return $this->render('FrontFrontBundle:Home:city.html.twig', array(
//                    'page' => $page,
//                    'user' => $user,
//                    'people' => $people,
//                    'places' => $places,
//                    'introductions' => $introductions,
//                    'workshops' => $workshops,
//                    'concerts' => $concerts,
//                    'festivals' => $festivals,
//                    'photos' => $photos,
//                    'musics' => $musics,
//                    'photos' => $photos,
//                    'videos' => $videos,
//        ));
//    }
    // FAIRE UN SERVICE !!!! IDENTIQUE DANS PLUSIEURS CONTROLLERS
//    private function getCity($request){
//        
//        $em = $this->getDoctrine()->getManager();
//        $session = $this->getRequest()->getSession();
//        
//        $searchcity = $request->get('searchcity', '', true);
//        if (!$searchcity)
//            $searchcity = $session->get('city');
//
//        if (!$searchcity)
//            return new response('', 404);
//
//        $city = $em->getRepository('FrontFrontBundle:City')->findOneBy(array('searchcity' => $searchcity));
//
//        if (isset($city) && $city) {
//            $session->set('latitude', $city->getLatitude());
//            $session->set('longitude', $city->getLongitude());
//            $session->set('city', $city->getSearchcity());
//        } else {
//
//            $city = new City();
//            $city->setSearchcity(trim(strtolower($searchcity)));
//
//            try {
//                $this->setLatitudeAndLongitude($city);
//                $em->persist($city);
//                $em->flush();
//
//                $session = $this->getRequest()->getSession();
//                $session->set('latitude', $city->getLatitude());
//                $session->set('longitude', $city->getLongitude());
//                $session->set('city', $city->getSearchcity());
//            } catch (\Exception $e) {
//                
//            }
//        }
//        
//        return $city;
//    }
}
