<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * City controller.
 *
 */
class FestivalController extends Controller {

    private $max_results = 30;
    private $add_days = 'P365D';
    private $startdate = null;
    private $stopdate = null;
    private $tomorrow = null;
    private $array_coordinates_europe = array(
        array(
            'name' => 'budapest',
            'latitude' => '47.49801',
            'longitude' => '19.03991',
            'distance' => 1000,
        ),
        array(
            'name' => 'paris',
            'latitude' => '48.856614',
            'longitude' => '2.3522219',
            'distance' => 1000,
        )
    );

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

    public function europeAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('festival_europe');
        if (!$page)
            throw new \Exception('Page not found!');

        $this->setDates($request);

        $eventTypeFestival = $em->getRepository('FrontFrontBundle:EventType')->findOneByName('Festival');

        $nextEvents = $em->getRepository('FrontFrontBundle:Event')
                ->findByContinent($this->max_results, array($eventTypeFestival), null, $this->startdate, $this->stopdate, $this->array_coordinates_europe);

        $user = $this->getUser();

        return $this->render('FrontFrontBundle:Festival:festivals.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
                    'latitude' => '47.49801',
                    'longitude' => '19.03991',
                    'map_zoom' => '4',
        ));
    }

    private function incrementDisplayCountersForPeople($people) {
        $displayCountersServices = $this->get('displayCounters.services');
        foreach ($people as $user)
            $displayCountersServices->updateUserDisplayCounter($user);
    }

}
