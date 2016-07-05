<?php

namespace Api\ApiV1Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations\Get;

class EventController extends FOSRestController {

    private $max_results = 25;

    /**
     * List events.
     * 
     * @Get("/events/latitude/{latitude}/longitude/{longitude}/locale/{_locale}/day/{day}")
     *
     * @Annotations\View(
     *  templateVar="events"
     * )
     *
     * @param latitude     $latitude      the latitude
     * @param longitude     $longitude      the longitude
     * @param locale     $_locale      the event locale
     * @param day     $day      the day
     *
     * @return array
     */
    public function getEventsAction($latitude = null, $longitude = null, $_locale = 'en', $day = null) {
        if (!$latitude or ! $longitude)
            throw $this->createNotFoundException('Error lat/lon.');
        if (!$day)
            $date = new \DateTime();
        else
            $date = \DateTime::createFromFormat('Y-m-d', $day);

        $startdate = $date->format('Y-m-d');
        $tomorrowDateTime = new \DateTime($startdate);
        $tomorrowDateTime->add(new \DateInterval('P1D'));
        $tomorrow = $tomorrowDateTime->format('Y-m-d');

        $em = $this->getDoctrine()->getManager();

        $events = $this->getEvents($em, true, $this->max_results, null, null, $startdate, $tomorrow, (float) $latitude, (float) $longitude);
        if (!count($events))
            $events = $this->getEvents($em, true, $this->max_results, null, null, $startdate, $tomorrow, (float) $latitude, (float) $longitude, 50);

        return array('events' => $events);
    }

    private function getEvents($em, $startdate_only = true, $limit = 6, $eventTypes = null, $musicTypes = null, $startdate = null, $stopdate = null, $latitude = null, $longitude = null, $distance = 20, $excludedEvents = array()) {

        $events = $em->getRepository('FrontFrontBundle:Event')
                ->findForCitypages($startdate_only, $limit, $eventTypes, $musicTypes, $startdate, $stopdate, $latitude, $longitude, 20, $excludedEvents);

        return $events;
    }

    /**
     * Get single Page.
     *
     * @Get("/event/{id}/locale/{_locale}")
     * 
     * @Annotations\View(templateVar="event")
     *
     * @param int     $id      the event id
     * @param locale     $_locale      the event locale
     *
     * @return array
     *
     * @throws NotFoundHttpException when event not exist
     */
    public function getEventAction($id, $_locale = 'en') {

        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('FrontFrontBundle:Event')->find(array('id' => $id));
        if (!$event) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        return array('event' => $event);
    }

}
