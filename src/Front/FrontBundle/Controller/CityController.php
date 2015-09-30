<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\City;
use Front\FrontBundle\Form\CityType;

/**
 * City controller.
 *
 */
class CityController extends Controller {

    private $max_results = 6;
    private $add_days = 'P30D';
    private $startdate = null;
    private $stopdate = null;
    private $tomorrow = null;

    private function setDates($request) {
        $session = $this->getRequest()->getSession();
        $startdate = $request->get('searcheventdate', '', true);
        if (!$startdate)
            $startdate = $session->get('startdate');
        if (!$startdate)
            $startdate = date('Y-m-d');
        $tomorrowDateTime = new \DateTime($startdate);
        $tomorrowDateTime->add(new \DateInterval('P1D'));
        $tomorrow = $tomorrowDateTime->format('Y-m-d');
        $stopDateTime = new \DateTime($startdate);
        $stopDateTime->add(new \DateInterval($this->add_days));
        $stopdate = $stopDateTime->format('Y-m-d');
        $session->set('startdate', $startdate);
        $session->set('tomorrow', $tomorrow);
        $session->set('stopdate', $stopdate);
        $this->startdate = $startdate;
        $this->stopdate = $stopdate;
        $this->tomorrow = $tomorrow;
    }

    public function calendarAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('calendar');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);
        $this->setDates($request);

        $musicTypes = $em->getRepository('FrontFrontBundle:MusicType')->findById($session->get('musicTypes'));
        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findById($session->get('eventTypes'));

        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, $musicTypes, $this->startdate, $this->tomorrow, $city->getLatitude(), $city->getLongitude());
        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, $musicTypes, $this->tomorrow, $this->stopdate, $city->getLatitude(), $city->getLongitude(), null, $events);

        $user = $this->getUser();

        return $this->render('FrontFrontBundle:City:calendar.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'events' => $events,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
        ));
    }

    public function dancersAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('dancers');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $UserType = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('dancer');

        $People = $this->getUsers($em, 200, $city->getLatitude(), $city->getLongitude(), 20, array($UserType));

        return $this->render('FrontFrontBundle:City:dancers.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'people' => $People,
        ));
    }

    public function teachersAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('teachers');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $UserType = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('teacher');

        $People = $this->getUsers($em, 200, $city->getLatitude(), $city->getLongitude(), 20, array($UserType));

        return $this->render('FrontFrontBundle:City:teachers.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'people' => $People,
        ));
    }

    public function artistsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('artists');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $UserType = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('artist');

        $People = $this->getUsers($em, 200, $city->getLatitude(), $city->getLongitude(), 20, array($UserType));

        return $this->render('FrontFrontBundle:City:artists.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'people' => $People,
        ));
    }

    public function introductionsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('introductions');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $this->setDates($request);

        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findById(array(4));

        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, null, $this->startdate, $this->tomorrow, $city->getLatitude(), $city->getLongitude());
        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, null, $this->tomorrow, $this->stopdate, $city->getLatitude(), $city->getLongitude(), null, $events);

        return $this->render('FrontFrontBundle:City:introductions.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'events' => $events,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
        ));
    }

    public function workshopsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('introductions');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $this->setDates($request);

        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findById(array(3, 7));

        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, null, $this->startdate, $this->tomorrow, $city->getLatitude(), $city->getLongitude());
        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, null, $this->tomorrow, $this->stopdate, $city->getLatitude(), $city->getLongitude(), null, $events);

        return $this->render('FrontFrontBundle:City:workshops.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'events' => $events,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
        ));
    }

    public function concertsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('introductions');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $this->setDates($request);

        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findById(array(6));

        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, null, $this->startdate, $this->tomorrow, $city->getLatitude(), $city->getLongitude());
        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, null, $this->tomorrow, $this->stopdate, $city->getLatitude(), $city->getLongitude(), null, $events);

        return $this->render('FrontFrontBundle:City:concerts.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'events' => $events,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
        ));
    }

    public function festivalsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('introductions');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $this->add_days = 'P1Y';
        $this->setDates($request);

        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findById(array(2));

        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, null, $this->startdate, $this->tomorrow, $city->getLatitude(), $city->getLongitude());
        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, null, $this->tomorrow, $this->stopdate, $city->getLatitude(), $city->getLongitude(), null, $events);

        return $this->render('FrontFrontBundle:City:festivals.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'events' => $events,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
        ));
    }

    public function photosAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('photos');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $photos = $this->getPhotos($em, 6, $city->getLatitude(), $city->getLongitude());

        return $this->render('FrontFrontBundle:City:photos.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'photos' => $photos,
        ));
    }

    public function musicsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('musics');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $musics = $this->getMusics($em, 6, $city->getLatitude(), $city->getLongitude());

        return $this->render('FrontFrontBundle:City:musics.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'musics' => $musics,
        ));
    }

    public function videosAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('videos');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $videos = $this->getVideos($em, 6, $city->getLatitude(), $city->getLongitude());

        return $this->render('FrontFrontBundle:City:videos.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'videos' => $videos,
        ));
    }

    private function getUsers($em, $limit = 6, $latitude = null, $longitude = null, $distance = 20, $userTypes = null) {

        $users = $em->getRepository('UserUserBundle:User')
                ->findUserByLocation($limit, $latitude, $longitude, $distance, $userTypes);

        return $users;
    }

    private function getPhotos($em, $limit = 6, $latitude = null, $longitude = null, $distance = 20) {

        $userFiles = $em->getRepository('UserUserBundle:UserFile')
                ->findPhotosByLocation($limit, $latitude, $longitude, $distance);
        $eventFiles = $em->getRepository('FrontFrontBundle:EventFile')
                ->findPhotosByLocation($limit, $latitude, $longitude, $distance);

        $photos = array_merge($userFiles, $eventFiles);
        shuffle($photos);

        return $photos;
    }

    private function getMusics($em, $limit = 6, $latitude = null, $longitude = null, $distance = 20) {

        $musics = $em->getRepository('FrontFrontBundle:Music')
                ->findMusicsByLocation($limit, $latitude, $longitude, $distance);

        shuffle($musics);

        return $musics;
    }

    private function getVideos($em, $limit = 6, $latitude = null, $longitude = null, $distance = 20) {

        $videos = $em->getRepository('FrontFrontBundle:Video')
                ->findVideosByLocation($limit, $latitude, $longitude, $distance);

        shuffle($videos);

        return $videos;
    }

    private function getCity($request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $searchcity = $request->get('searchcity', '', true);
        if (!$searchcity)
            $searchcity = $session->get('city');

        if (!$searchcity)
            return new response('', 404);

        $city = $em->getRepository('FrontFrontBundle:City')->findOneBy(array('searchcity' => $searchcity));

        if (isset($city) && $city) {
            $session->set('latitude', $city->getLatitude());
            $session->set('longitude', $city->getLongitude());
            $session->set('city', $city->getSearchcity());
        } else {

            $city = new City();
            $city->setSearchcity(trim(strtolower($searchcity)));

            try {
                $this->setLatitudeAndLongitude($city);
                $em->persist($city);
                $em->flush();

                $session = $this->getRequest()->getSession();
                $session->set('latitude', $city->getLatitude());
                $session->set('longitude', $city->getLongitude());
                $session->set('city', $city->getSearchcity());
            } catch (\Exception $e) {
                
            }
        }

        return $city;
    }

    private function getEvents($em, $startdate_only = true, $limit = 6, $eventTypes = null, $musicTypes = null, $startdate = null, $stopdate = null, $latitude = null, $longitude = null, $distance = 20, $excludedEvents = array()) {

        $events = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages($startdate_only, $limit, $eventTypes, $musicTypes, $startdate, $stopdate, $latitude, $longitude, 20, $excludedEvents);

        return $events;
    }

    private function setLatitudeAndLongitude($city) {
        try {
            $geocode = $this->container
                    ->get('bazinga_geocoder.geocoder')
                    ->using('google_maps')
                    ->geocode($city->getSearchcity());

            $city->setLatitude($geocode['latitude']);
            $city->setLongitude($geocode['longitude']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
