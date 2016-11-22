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

    public function editoAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_edito');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);
        $this->setDates($request);

//        $musicTypes = $em->getRepository('FrontFrontBundle:MusicType')->findById($session->get('musicTypes'));
//        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findById($session->get('eventTypes'));
//
//        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, $musicTypes, $this->startdate, $this->tomorrow, $city->getLatitude(), $city->getLongitude());
//        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, $musicTypes, $this->tomorrow, $this->stopdate, $city->getLatitude(), $city->getLongitude(), null, $events);

        $user = $this->getUser();

//        $UserTypeArtist = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('artist');
//        $UserTypeTeacher = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('teacher');
//        $UserTypeBar = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('bar');

        $musicTypeSalsa = $em->getRepository('FrontFrontBundle:MusicType')->findOneByName('Salsa');
        $musicTypeBachata = $em->getRepository('FrontFrontBundle:MusicType')->findOneByName('Bachata');
        $musicTypeKizomba = $em->getRepository('FrontFrontBundle:MusicType')->findOneByName('Kizomba');

        $eventTypeFestival = $em->getRepository('FrontFrontBundle:EventType')->findOneByName('Festival');
        $eventTypeParty = $em->getRepository('FrontFrontBundle:EventType')->findOneByName('Party');
        $eventTypeIntroduction = $em->getRepository('FrontFrontBundle:EventType')->findOneByName('Introduction');
        $eventTypeWorkshop = $em->getRepository('FrontFrontBundle:EventType')->findOneByName('Workshop');

//        $People = $this->getUsers($em, 200, $city->getLatitude(), $city->getLongitude(), 40, array($UserTypeArtist, $UserTypeTeacher, $UserTypeBar));
//findForCitypages($startdate_only = true, $limit = 6, $eventTypes = null, $musicTypes = null, $startdate = null, $stopdate = null, $latitude = null, $longitude = null, $distance = 20, $excludedEvents = array())

        $festivalSalsaNext = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, array($eventTypeFestival), array($musicTypeSalsa), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());
        $festivalBachataNext = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, array($eventTypeFestival), array($musicTypeBachata), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());
        $festivalKizombaNext = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, array($eventTypeFestival), array($musicTypeKizomba), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());

        $eventSalsaNext = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, null, array($musicTypeSalsa), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());
        $eventBachataNext = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, null, array($musicTypeBachata), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());
        $eventKizombaNext = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, null, array($musicTypeKizomba), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());

        $introductionsSalsa = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, array($eventTypeIntroduction), array($musicTypeSalsa), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());
        $introductionsBachata = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, array($eventTypeIntroduction), array($musicTypeBachata), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());
        $introductionsKizomba = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, array($eventTypeIntroduction), array($musicTypeKizomba), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());

        $introductionOrganisers = null;

        $lessonsSalsa = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, array($eventTypeWorkshop), array($musicTypeSalsa), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());
        $lessonsBachata = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, array($eventTypeWorkshop), array($musicTypeBachata), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());
        $lessonsKizomba = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, array($eventTypeWorkshop), array($musicTypeKizomba), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());

        $lessonOrganisers = null;

        $partiesSalsa = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, array($eventTypeParty), array($musicTypeSalsa), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());
        $partiesBachata = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, array($eventTypeParty), array($musicTypeBachata), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());
        $partiesKizomba = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages(false, 3, array($eventTypeParty), array($musicTypeKizomba), date('Y-m-d'), null, $city->getLatitude(), $city->getLongitude());

        $partyOrganisers = null;

        $lastYearDateTime = new \DateTime();
        $lastYear = $lastYearDateTime->modify('-365 days')->format('Y-m-d');
        $last2MonthDateTime = new \DateTime();
        $last2Month = $last2MonthDateTime->modify('-60 days')->format('Y-m-d');
        $nextYearDateTime = new \DateTime();
        $nextYearDateTime->add(new \DateInterval('P365D'));
        $nextYear = $nextYearDateTime->format('Y-m-d');
        $nextWeekDateTime = new \DateTime();
        $nextWeekDateTime->add(new \DateInterval('P7D'));
        $nextWeek = $nextWeekDateTime->format('Y-m-d');
        $nextMonthDateTime = new \DateTime();
        $nextMonthDateTime->add(new \DateInterval('P30D'));
        $nextMonth = $nextMonthDateTime->format('Y-m-d');
        $next2MonthDateTime = new \DateTime();
        $next2MonthDateTime->add(new \DateInterval('P60D'));
        $next2Month = $next2MonthDateTime->format('Y-m-d');

        $TOTAL_EVENTS = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(null, null, $lastYear, $nextYear, $city->getLatitude(), $city->getLongitude());
        $TOTAL_WEEK = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(null, null, null, $nextWeek, $city->getLatitude(), $city->getLongitude());
        $TOTAL_MONTH = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(null, null, null, $nextMonth, $city->getLatitude(), $city->getLongitude());
        $TOTAL_MONTH_SALSA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(null, array($musicTypeSalsa), null, $nextMonth, $city->getLatitude(), $city->getLongitude());
        $TOTAL_MONTH_BACHATA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(null, array($musicTypeBachata), null, $nextMonth, $city->getLatitude(), $city->getLongitude());
        $TOTAL_MONTH_KIZOMBA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(null, array($musicTypeKizomba), null, $nextMonth, $city->getLatitude(), $city->getLongitude());

        $TOTAL_INTRODUCTION = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeIntroduction), null, $lastYear, $nextYear, $city->getLatitude(), $city->getLongitude());
        $TOTAL_INTRODUCTION_SALSA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeIntroduction), array($musicTypeSalsa), null, $nextYear, $city->getLatitude(), $city->getLongitude());
        $TOTAL_INTRODUCTION_BACHATA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeIntroduction), array($musicTypeBachata), null, $nextYear, $city->getLatitude(), $city->getLongitude());
        $TOTAL_INTRODUCTION_KIZOMBA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeIntroduction), array($musicTypeKizomba), null, $nextYear, $city->getLatitude(), $city->getLongitude());
        $AVG_MONTH_INTRODUCTION_SALSA = ($em->getRepository('FrontFrontBundle:Event')
                        ->countForEdito(array($eventTypeIntroduction), array($musicTypeSalsa), $last2Month, $next2Month, $city->getLatitude(), $city->getLongitude()) / 4);
        $AVG_MONTH_INTRODUCTION_BACHATA = ($em->getRepository('FrontFrontBundle:Event')
                        ->countForEdito(array($eventTypeIntroduction), array($musicTypeBachata), $last2Month, $next2Month, $city->getLatitude(), $city->getLongitude()) / 4);
        $AVG_MONTH_INTRODUCTION_KIZOMBA = ($em->getRepository('FrontFrontBundle:Event')
                        ->countForEdito(array($eventTypeIntroduction), array($musicTypeKizomba), $last2Month, $next2Month, $city->getLatitude(), $city->getLongitude()) / 4);

        $TOTAL_LESSON = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeWorkshop), null, $lastYear, $nextYear, $city->getLatitude(), $city->getLongitude());
        $TOTAL_LESSON_SALSA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeWorkshop), array($musicTypeSalsa), null, $nextYear, $city->getLatitude(), $city->getLongitude());
        $TOTAL_LESSON_BACHATA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeWorkshop), array($musicTypeSalsa), null, $nextYear, $city->getLatitude(), $city->getLongitude());
        $TOTAL_LESSON_KIZOMBA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeWorkshop), array($musicTypeSalsa), null, $nextYear, $city->getLatitude(), $city->getLongitude());
        $AVG_MONTH_LESSON_SALSA = ($em->getRepository('FrontFrontBundle:Event')
                        ->countForEdito(array($eventTypeWorkshop), array($musicTypeSalsa), $last2Month, $next2Month, $city->getLatitude(), $city->getLongitude()) / 4);
        $AVG_MONTH_LESSON_BACHATA = ($em->getRepository('FrontFrontBundle:Event')
                        ->countForEdito(array($eventTypeWorkshop), array($musicTypeBachata), $last2Month, $next2Month, $city->getLatitude(), $city->getLongitude()) / 4);
        $AVG_MONTH_LESSON_KIZOMBA = ($em->getRepository('FrontFrontBundle:Event')
                        ->countForEdito(array($eventTypeWorkshop), array($musicTypeKizomba), $last2Month, $next2Month, $city->getLatitude(), $city->getLongitude()) / 4);

        $TOTAL_PARTY = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeParty), null, $lastYear, $nextYear, $city->getLatitude(), $city->getLongitude());
        $TOTAL_PARTY_SALSA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeParty), array($musicTypeSalsa), null, $nextYear, $city->getLatitude(), $city->getLongitude());
        $TOTAL_PARTY_BACHATA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeParty), array($musicTypeSalsa), null, $nextYear, $city->getLatitude(), $city->getLongitude());
        $TOTAL_PARTY_KIZOMBA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeParty), array($musicTypeSalsa), null, $nextYear, $city->getLatitude(), $city->getLongitude());
        $AVG_MONTH_PARTY_SALSA = ($em->getRepository('FrontFrontBundle:Event')
                        ->countForEdito(array($eventTypeParty), array($musicTypeSalsa), $last2Month, $next2Month, $city->getLatitude(), $city->getLongitude()) / 4);
        $AVG_MONTH_PARTY_BACHATA = ($em->getRepository('FrontFrontBundle:Event')
                        ->countForEdito(array($eventTypeParty), array($musicTypeBachata), $last2Month, $next2Month, $city->getLatitude(), $city->getLongitude()) / 4);
        $AVG_MONTH_PARTY_KIZOMBA = ($em->getRepository('FrontFrontBundle:Event')
                        ->countForEdito(array($eventTypeParty), array($musicTypeKizomba), $last2Month, $next2Month, $city->getLatitude(), $city->getLongitude()) / 4);
        $TOTAL_WEEK_PARTY_SALSA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeParty), array($musicTypeSalsa), null, $nextWeek, $city->getLatitude(), $city->getLongitude());
        $TOTAL_WEEK_PARTY_BACHATA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeParty), array($musicTypeBachata), null, $nextWeek, $city->getLatitude(), $city->getLongitude());
        $TOTAL_WEEK_PARTY_KIZOMBA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeParty), array($musicTypeKizomba), null, $nextWeek, $city->getLatitude(), $city->getLongitude());

        $TOTAL_FESTIVAL_SALSA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeFestival), array($musicTypeSalsa), null, $nextYear, $city->getLatitude(), $city->getLongitude());
        $TOTAL_FESTIVAL_BACHATA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeFestival), array($musicTypeSalsa), null, $nextYear, $city->getLatitude(), $city->getLongitude());
        $TOTAL_FESTIVAL_KIZOMBA = $em->getRepository('FrontFrontBundle:Event')
                ->countForEdito(array($eventTypeFestival), array($musicTypeSalsa), null, $nextYear, $city->getLatitude(), $city->getLongitude());

        return $this->render('FrontFrontBundle:City:edito.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'startdate' => $this->startdate,
                    "festivalSalsaNext" => $festivalSalsaNext,
                    "festivalBachataNext" => $festivalBachataNext,
                    "festivalKizombaNext" => $festivalKizombaNext,
                    "eventSalsaNext" => $eventSalsaNext,
                    "eventBachataNext" => $eventBachataNext,
                    "eventKizombaNext" => $eventKizombaNext,
                    "introductionsSalsa" => $introductionsSalsa,
                    "introductionsBachata" => $introductionsBachata,
                    "introductionsKizomba" => $introductionsKizomba,
                    "introductionOrganisers" => $introductionOrganisers,
                    "lessonsSalsa" => $lessonsSalsa,
                    "lessonsBachata" => $lessonsBachata,
                    "lessonsKizomba" => $lessonsKizomba,
                    "lessonOrganisers" => $lessonOrganisers,
                    "partiesSalsa" => $partiesSalsa,
                    "partiesBachata" => $partiesBachata,
                    "partiesKizomba" => $partiesKizomba,
                    "partyOrganisers" => $partyOrganisers,
                    "TOTAL_EVENTS" => $TOTAL_EVENTS,
                    "TOTAL_WEEK" => $TOTAL_WEEK,
                    "TOTAL_MONTH" => $TOTAL_MONTH,
                    "TOTAL_MONTH_SALSA" => $TOTAL_MONTH_SALSA,
                    "TOTAL_MONTH_BACHATA" => $TOTAL_MONTH_BACHATA,
                    "TOTAL_MONTH_KIZOMBA" => $TOTAL_MONTH_KIZOMBA,
                    "TOTAL_INTRODUCTION" => $TOTAL_INTRODUCTION,
                    "TOTAL_INTRODUCTION_SALSA" => $TOTAL_INTRODUCTION_SALSA,
                    "TOTAL_INTRODUCTION_BACHATA" => $TOTAL_INTRODUCTION_BACHATA,
                    "TOTAL_INTRODUCTION_KIZOMBA" => $TOTAL_INTRODUCTION_KIZOMBA,
                    "AVG_MONTH_INTRODUCTION_SALSA" => round($AVG_MONTH_INTRODUCTION_SALSA),
                    "AVG_MONTH_INTRODUCTION_BACHATA" => round($AVG_MONTH_INTRODUCTION_BACHATA),
                    "AVG_MONTH_INTRODUCTION_KIZOMBA" => round($AVG_MONTH_INTRODUCTION_KIZOMBA),
                    "TOTAL_LESSON" => $TOTAL_LESSON,
                    "TOTAL_LESSON_SALSA" => $TOTAL_LESSON_SALSA,
                    "TOTAL_LESSON_BACHATA" => $TOTAL_LESSON_BACHATA,
                    "TOTAL_LESSON_KIZOMBA" => $TOTAL_LESSON_KIZOMBA,
                    "AVG_MONTH_LESSON_SALSA" => round($AVG_MONTH_LESSON_SALSA),
                    "AVG_MONTH_LESSON_BACHATA" => round($AVG_MONTH_LESSON_BACHATA),
                    "AVG_MONTH_LESSON_KIZOMBA" => round($AVG_MONTH_LESSON_KIZOMBA),
                    "TOTAL_PARTY" => $TOTAL_PARTY,
                    "TOTAL_PARTY_SALSA" => $TOTAL_PARTY_SALSA,
                    "TOTAL_PARTY_BACHATA" => $TOTAL_PARTY_BACHATA,
                    "TOTAL_PARTY_KIZOMBA" => $TOTAL_PARTY_KIZOMBA,
                    "AVG_MONTH_PARTY_SALSA" => round($AVG_MONTH_PARTY_SALSA),
                    "AVG_MONTH_PARTY_BACHATA" => round($AVG_MONTH_PARTY_BACHATA),
                    "AVG_MONTH_PARTY_KIZOMBA" => round($AVG_MONTH_PARTY_KIZOMBA),
                    "TOTAL_WEEK_PARTY_SALSA" => $TOTAL_WEEK_PARTY_SALSA,
                    "TOTAL_WEEK_PARTY_BACHATA" => $TOTAL_WEEK_PARTY_BACHATA,
                    "TOTAL_WEEK_PARTY_KIZOMBA" => $TOTAL_WEEK_PARTY_KIZOMBA,
                    "TOTAL_FESTIVAL_SALSA" => $TOTAL_FESTIVAL_SALSA,
                    "TOTAL_FESTIVAL_BACHATA" => $TOTAL_FESTIVAL_BACHATA,
                    "TOTAL_FESTIVAL_KIZOMBA" => $TOTAL_FESTIVAL_KIZOMBA,
        ));
    }

    public function calendarAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_calendar');
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
                    'city' => $city,
                    'user' => $user,
                    'events' => $events,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
        ));
    }

    public function dancersAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_dancer');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $UserType = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('dancer');

        $query = $this->getUsersQuery($em, 200, $city->getLatitude(), $city->getLongitude(), 20, array($UserType));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );
        $this->incrementDisplayCountersForPeople($pagination);

        return $this->render('FrontFrontBundle:City:dancers.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'userType' => $UserType,
                    'pagination' => $pagination,
        ));
    }

    public function teachersAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_teacher');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $UserType = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('teacher');

        $query = $this->getUsersQuery($em, 200, $city->getLatitude(), $city->getLongitude(), 20, array($UserType));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );
        $this->incrementDisplayCountersForPeople($pagination);

        return $this->render('FrontFrontBundle:City:teachers.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'userType' => $UserType,
                    'pagination' => $pagination,
        ));
    }

    public function artistsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_artist');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $UserType = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('artist');

        $query = $this->getUsersQuery($em, 200, $city->getLatitude(), $city->getLongitude(), 20, array($UserType));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );
        $this->incrementDisplayCountersForPeople($pagination);

        return $this->render('FrontFrontBundle:City:artists.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'userType' => $UserType,
                    'pagination' => $pagination,
        ));
    }

    public function barsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_bar');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $UserType = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('bar');

        $query = $this->getUsersQuery($em, 200, $city->getLatitude(), $city->getLongitude(), 20, array($UserType));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );
        $this->incrementDisplayCountersForPeople($pagination);

        return $this->render('FrontFrontBundle:City:bars.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'userType' => $UserType,
                    'pagination' => $pagination,
        ));
    }

    public function introductionsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_introduction');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $this->setDates($request);

        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findByName(array('Introduction'));

        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, null, $this->startdate, $this->tomorrow, $city->getLatitude(), $city->getLongitude());
        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, null, $this->tomorrow, $this->stopdate, $city->getLatitude(), $city->getLongitude(), null, $events);

        return $this->render('FrontFrontBundle:City:introductions.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'events' => $events,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
        ));
    }

    public function workshopsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_workshop');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $this->setDates($request);

        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findByName(array('Workshop'));

        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, null, $this->startdate, $this->tomorrow, $city->getLatitude(), $city->getLongitude());
        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, null, $this->tomorrow, $this->stopdate, $city->getLatitude(), $city->getLongitude(), null, $events);

        return $this->render('FrontFrontBundle:City:workshops.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'events' => $events,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
        ));
    }

    public function partiesAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_party');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $this->setDates($request);

        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findByName(array('Party'));

        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, null, $this->startdate, $this->tomorrow, $city->getLatitude(), $city->getLongitude());
        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, null, $this->tomorrow, $this->stopdate, $city->getLatitude(), $city->getLongitude(), null, $events);

        return $this->render('FrontFrontBundle:City:parties.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'events' => $events,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
        ));
    }

    public function showsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_show');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $this->setDates($request);

        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findByName(array('Show'));

        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, null, $this->startdate, $this->tomorrow, $city->getLatitude(), $city->getLongitude());
        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, null, $this->tomorrow, $this->stopdate, $city->getLatitude(), $city->getLongitude(), null, $events);

        return $this->render('FrontFrontBundle:City:shows.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'events' => $events,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
        ));
    }

    public function concertsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_concert');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $this->setDates($request);

        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findByName(array('Concert'));

        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, null, $this->startdate, $this->tomorrow, $city->getLatitude(), $city->getLongitude());
        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, null, $this->tomorrow, $this->stopdate, $city->getLatitude(), $city->getLongitude(), null, $events);

        return $this->render('FrontFrontBundle:City:concerts.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'events' => $events,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
        ));
    }

    public function festivalsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_festival');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $this->add_days = 'P1Y';
        $this->setDates($request);

        $eventTypes = $em->getRepository('FrontFrontBundle:EventType')->findByName(array('Festival', 'Congress'));

        $events = $this->getEvents($em, true, $this->max_results, $eventTypes, null, $this->startdate, $this->tomorrow, $city->getLatitude(), $city->getLongitude());
        $nextEvents = $this->getEvents($em, false, $this->max_results, $eventTypes, null, $this->tomorrow, $this->stopdate, $city->getLatitude(), $city->getLongitude(), null, $events);

        return $this->render('FrontFrontBundle:City:festivals.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'events' => $events,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
        ));
    }

    public function photosAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_photo');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $photos = $this->getPhotos($em, 6, $city->getLatitude(), $city->getLongitude());

        return $this->render('FrontFrontBundle:City:photos.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'photos' => $photos,
        ));
    }

    public function musicsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_music');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $musics = $this->getMusics($em, 6, $city->getLatitude(), $city->getLongitude());

        return $this->render('FrontFrontBundle:City:musics.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'musics' => $musics,
        ));
    }

    public function videosAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('city_video');
        if (!$page)
            throw new \Exception('Page not found!');

        $city = $this->getCity($request);

        $user = $this->getUser();

        $videos = $this->getVideos($em, 6, $city->getLatitude(), $city->getLongitude());

        return $this->render('FrontFrontBundle:City:videos.html.twig', array(
                    'page' => $page,
                    'city' => $city,
                    'user' => $user,
                    'videos' => $videos,
        ));
    }

    private function getUsers($em, $limit = 6, $latitude = null, $longitude = null, $distance = 20, $userTypes = null) {

        $users = $em->getRepository('UserUserBundle:User')
                ->findUserByLocation($limit, $latitude, $longitude, $distance, $userTypes);

        return $users;
    }

    private function getUsersQuery($em, $limit = 6, $latitude = null, $longitude = null, $distance = 20, $userTypes = null) {

        $query = $em->getRepository('UserUserBundle:User')
                ->findUserByLocationQuery($limit, $latitude, $longitude, $distance, $userTypes);

        return $query;
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

        $city = $em->getRepository('FrontFrontBundle:City')->findOneBy(array('name' => $searchcity));

        if (isset($city) && $city) {
            $session->set('latitude', $city->getLatitude());
            $session->set('longitude', $city->getLongitude());
            $session->set('city', $city->getName());
        } else {
            $city = new City();
            $city->setName(trim(strtolower($searchcity)));

            try {
                $this->setLatitudeAndLongitude($city);
                $em->persist($city);
                $em->flush();

                $session = $this->getRequest()->getSession();
                $session->set('latitude', $city->getLatitude());
                $session->set('longitude', $city->getLongitude());
                $session->set('city', $city->getName());
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

    private function setLatitudeAndLongitude($city = null) {
        if (!$city)
            return;
        try {
            $geocodeAddresses = $this->container
                    ->get('bazinga_geocoder.geocoder')
                    ->using('google_maps')
                    ->geocode($city->getName());
            if (!count($geocodeAddresses))
                return;

            foreach ($geocodeAddresses as $geocodeAddress) {
                $city->setLatitude($geocodeAddress->getLatitude());
                $city->setLongitude($geocodeAddress->getLongitude());
                return;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function numbersAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $city = $this->getCity($request);

        $this->setDates($request);
        $count_events = $em->getRepository('FrontFrontBundle:Event')->countForCitypages($this->startdate, $city->getLatitude(), $city->getLongitude());

        $UserTypeBar = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('bar');
        $count_bars = $em->getRepository('UserUserBundle:User')->countUserByLocation($city->getLatitude(), $city->getLongitude(), 20, array($UserTypeBar));
        $UserTypeDancer = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('dancer');
        $count_dancers = $em->getRepository('UserUserBundle:User')->countUserByLocation($city->getLatitude(), $city->getLongitude(), 20, array($UserTypeDancer));
        $UserTypeTeacher = $this->getDoctrine()->getRepository('UserUserBundle:UserType')->findOneByName('teacher');
        $count_teachers = $em->getRepository('UserUserBundle:User')->countUserByLocation($city->getLatitude(), $city->getLongitude(), 20, array($UserTypeTeacher));

        return $this->render('FrontFrontBundle:City:numbers.html.twig', array(
                    'count_events' => $count_events,
                    'count_bars' => $count_bars,
                    'count_dancers' => $count_dancers,
                    'count_teachers' => $count_teachers,
        ));
    }

    private function incrementDisplayCountersForPeople($people) {
        $displayCountersServices = $this->get('displayCounters.services');
        foreach ($people as $user)
            $displayCountersServices->updateUserDisplayCounter($user);
    }

}
