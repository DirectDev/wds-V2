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
        array('name' => 'budapest', 'latitude' => '47.49801', 'longitude' => '19.03991', 'distance' => 1300,),
        array('name' => 'madrid', 'latitude' => '40.202002', 'longitude' => '-3.76209', 'distance' => 550,),
        array('name' => 'bulgarie', 'latitude' => '41.424449', 'longitude' => '25.940162', 'distance' => 700,),
        array('name' => 'norgeve', 'latitude' => '59.212217', 'longitude' => '10.036587', 'distance' => 1000,),
        array('name' => 'moscrou', 'latitude' => '55.717256', 'longitude' => '37.63468', 'distance' => 1200,),
        array('name' => 'london', 'latitude' => '51.500152', 'longitude' => '-0.126236', 'distance' => 1500,)
    );
    private $array_coordinates_north_america = array(
        array('name' => 'NY', 'latitude' => '40.712784', 'longitude' => '-74.005941', 'distance' => 2000,),
        array('name' => 'atlanta', 'latitude' => '33.717029', 'longitude' => '-84.26953', 'distance' => 2000,),
        array('name' => 'dallas', 'latitude' => '32.650476', 'longitude' => '-96.793944', 'distance' => 2000,),
        array('name' => 'LA', 'latitude' => '33.8996', 'longitude' => '-118.063475', 'distance' => 2000,),
        array('name' => 'mexico', 'latitude' => '19.261368', 'longitude' => '-98.99121', 'distance' => 1000,),
        array('name' => 'calgary', 'latitude' => '51.035867', 'longitude' => '-114.064452', 'distance' => 2000,),
        array('name' => 'ottawa', 'latitude' => '45.299621', 'longitude' => '-75.65625', 'distance' => 2000,),
    );
    private $array_coordinates_central_america = array(
        array('name' => 'georgetown', 'latitude' => '6.699524', 'longitude' => '-58.078129', 'distance' => 1300,),
        array('name' => 'bogota', 'latitude' => '4.469096', 'longitude' => '-73.986332', 'distance' => 1300,),
        array('name' => 'puerto rico', 'latitude' => '18.354526', 'longitude' => '-65.988286', 'distance' => 1300,),
        array('name' => 'guatemala', 'latitude' => '14.732386', 'longitude' => '-90.421879', 'distance' => 1300,),
        array('name' => 'santiago de cuba', 'latitude' => '19.952696', 'longitude' => '-75.774904', 'distance' => 800,),
    );
    private $array_coordinates_south_america = array(
        array('name' => 'lima', 'latitude' => '-12.21118', 'longitude' => '-76.869149', 'distance' => 1000,),
        array('name' => 'salvador', 'latitude' => '-13.068777', 'longitude' => '-38.478515', 'distance' => 1500,),
        array('name' => 'asuncion', 'latitude' => '-25.482951', 'longitude' => '-57.44531', 'distance' => 3000,),
    );
    private $array_coordinates_north_africa = array(
        array('name' => 'canarias', 'latitude' => '27.955591', 'longitude' => '-15.407225', 'distance' => 1000,),
        array('name' => 'marrakech', 'latitude' => '31.615966', 'longitude' => '-7.936522', 'distance' => 500,),
        array('name' => 'algeria', 'latitude' => '32.546813', 'longitude' => '3.357423', 'distance' => 600,),
        array('name' => 'tunisia', 'latitude' => '33.28462', 'longitude' => '10.489747', 'distance' => 500,),
        array('name' => 'cairo', 'latitude' => '29.954935', 'longitude' => '31.306642', 'distance' => 300,),
        array('name' => 'libya', 'latitude' => '25.641526', 'longitude' => '20.689455', 'distance' => 1000,),
        array('name' => 'bechar', 'latitude' => '29.840644', 'longitude' => '-2.865232', 'distance' => 725,),
    );
    private $array_coordinates_central_africa = array(
        array('name' => 'senegal', 'latitude' => '14.51978', 'longitude' => '-17.103513', 'distance' => 1000,),
        array('name' => 'lagos', 'latitude' => '6.489983', 'longitude' => '3.550783', 'distance' => 2000,),
        array('name' => 'kinshasa', 'latitude' => '-4.82826', 'longitude' => '15.328127', 'distance' => 1500,),
        array('name' => 'nairobi', 'latitude' => '-1.58183', 'longitude' => '36.949218', 'distance' => 1500,),
        array('name' => 'south sudan', 'latitude' => '8.667918', 'longitude' => '24.908203', 'distance' => 1900,),
    );
    private $array_coordinates_south_africa = array(
        array('name' => 'bostwana', 'latitude' => '-22.43134', 'longitude' => '28.072268', 'distance' => 2000,),
        array('name' => 'reunion', 'latitude' => '-21.371244', 'longitude' => '55.582033', 'distance' => 1500,),
    );
    private $array_coordinates_north_asia = array(
        array('name' => 'seoul', 'latitude' => '37.300275', 'longitude' => '126.773429', 'distance' => 1400,),
        array('name' => 'bejing', 'latitude' => '39.774769', 'longitude' => '116.402335', 'distance' => 1600,),
        array('name' => 'mongolia', 'latitude' => '46.13417', 'longitude' => '100.23046', 'distance' => 2000,),
        array('name' => 'kamchatka', 'latitude' => '51.344339', 'longitude' => '156.919913', 'distance' => 2000,),
    );
    private $array_coordinates_south_asia = array(
        array('name' => 'bangkok', 'latitude' => '13.410994', 'longitude' => '100.494132', 'distance' => 1500,),
        array('name' => 'taipei', 'latitude' => '24.926295', 'longitude' => '121.658199', 'distance' => 700,),
        array('name' => 'hongkong', 'latitude' => '22.105999', 'longitude' => '114.231441', 'distance' => 700,),
    );
    private $array_coordinates_india = array(
        array('name' => 'hyderabad', 'latitude' => '17.291905', 'longitude' => '78.521484', 'distance' => 2000,),
    );
    private $array_coordinates_australia = array(
        array('name' => 'australia', 'latitude' => '-26.839757', 'longitude' => '135.386718', 'distance' => 2000,),
        array('name' => 'perth', 'latitude' => '-32.034158', 'longitude' => '115.989259', 'distance' => 2000,),
        array('name' => 'tasmania', 'latitude' => '-42.241533', 'longitude' => '147.076171', 'distance' => 1300,),
        array('name' => 'auckland', 'latitude' => '-37.034128', 'longitude' => '174.849609', 'distance' => 1300,),
    );
    private $array_coordinates_indonesia = array(
        array('name' => 'jakarta', 'latitude' => '-6.188615', 'longitude' => '106.817872', 'distance' => 1300,),
        array('name' => 'samarinda', 'latitude' => '-0.531731', 'longitude' => '117.123047', 'distance' => 900,),
        array('name' => 'manile', 'latitude' => '14.426169', 'longitude' => '121.04297', 'distance' => 1000,),
        array('name' => 'lae', 'latitude' => '-6.760625', 'longitude' => '147.058595', 'distance' => 1200,),
        array('name' => 'teluk ambon', 'latitude' => '-3.712975', 'longitude' => '128.192871', 'distance' => 1200,),
    );
    private $array_coordinates_middle_east = array(
        array('name' => 'quatar', 'latitude' => '24.798703', 'longitude' => '51.433595', 'distance' => 1300,),
        array('name' => 'bagdad', 'latitude' => '31.645899', 'longitude' => '44.314454', 'distance' => 1300,),
        array('name' => 'tehran', 'latitude' => '35.668007', 'longitude' => '51.38965', 'distance' => 1300,),
        array('name' => 'jerusalem', 'latitude' => '33.240525', 'longitude' => '35.393556', 'distance' => 500,),
        array('name' => 'sana a', 'latitude' => '15.275706', 'longitude' => '44.226564', 'distance' => 400,),
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
        $this->setDates($request);
        return $this->continent('festival_europe', $this->array_coordinates_europe, 4, '47.49801', '19.03991');
    }

    public function northAmericaAction(Request $request) {
        $this->setDates($request);
        return $this->continent('festival_north_america', $this->array_coordinates_north_america, 4, '36.286793', '-97.312496');
    }

    public function centralAmericaAction(Request $request) {
        $this->setDates($request);
        return $this->continent('festival_central_america', $this->array_coordinates_central_america, 4, '10.453242', '-74.988277');
    }

    public function southAmericaAction(Request $request) {
        $this->setDates($request);
        return $this->continent('festival_south_america', $this->array_coordinates_south_america, 4, '-18.346185', '-56.707027');
    }

    public function northAfricaAction(Request $request) {
        $this->setDates($request);
        return $this->continent('festival_north_africa', $this->array_coordinates_north_africa, 4, '31.623451', '9.914061');
    }

    public function centralAfricaAction(Request $request) {
        $this->setDates($request);
        return $this->continent('festival_central_africa', $this->array_coordinates_central_africa, 4, '0.84372', '13.429686');
    }

    public function southAfricaAction(Request $request) {
        $this->setDates($request);
        return $this->continent('festival_south_africa', $this->array_coordinates_south_africa, 4, '-20.006386', '30.128905');
    }

    public function northAsiaAction(Request $request) {
        $this->setDates($request);
        return $this->continent('festival_north_asia', $this->array_coordinates_north_asia, 4, '37.829745', '117.492186');
    }

    public function southAsiaAction(Request $request) {
        $this->setDates($request);
        return $this->continent('festival_south_asia', $this->array_coordinates_south_asia, 4, '17.442896', '106.593749');
    }

    public function australiaAction(Request $request) {
        $this->setDates($request);
        return $this->continent('festival_australia', $this->array_coordinates_australia, 4, '-27.402985', '141.222655');
    }

    public function indiaAction(Request $request) {
        $this->setDates($request);
        return $this->continent('festival_india', $this->array_coordinates_india, 4, '21.420345', '77.589843');
    }

    public function indonesiaAction(Request $request) {
        $this->setDates($request);
        return $this->continent('festival_indonesia', $this->array_coordinates_indonesia, 4, '-1.616972', '126.105468');
    }

    public function middleEastAction(Request $request) {
        $this->setDates($request);
        return $this->continent('festival_middle_east', $this->array_coordinates_middle_east, 4, '24.495147', '51.046874');
    }

    private function continent($pagename, $array_coordinates, $map_zoom, $latitude, $longitude) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName($pagename);
        if (!$page)
            throw new \Exception('Page not found!');

        $eventTypeFestival = $em->getRepository('FrontFrontBundle:EventType')->findOneByName('Festival');

        $nextEvents = $em->getRepository('FrontFrontBundle:Event')
                ->findByContinent($this->max_results, array($eventTypeFestival), null, $this->startdate, $this->stopdate, $array_coordinates);

        $user = $this->getUser();

        return $this->render('FrontFrontBundle:Festival:festivals.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'map_zoom' => $map_zoom,
                    'array_coordinates' => $array_coordinates
        ));
    }

    public function calendarAction(Request $request, $startdate = null) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if ($startdate)
            $startdate = $session->get('startdate');

        $this->setDates($request);

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('festival_calendar');
        if (!$page)
            throw new \Exception('Page not found!');

        $eventTypeFestival = $em->getRepository('FrontFrontBundle:EventType')->findOneByName('Festival');

        $nextEvents = $em->getRepository('FrontFrontBundle:Event')
                ->findByContinent(50, array($eventTypeFestival), null, $this->startdate, $this->stopdate);

        $user = $this->getUser();

        $MeaCities = $this->getDoctrine()->getRepository('FrontFrontBundle:MeaCity')->findForHomePage(8);
        
        $nextWeekend = new \DateTime('next Friday');
        $in2Weeks = new \Datetime();
        $in2Weeks->modify('+14days');
        $in3Weeks = new \Datetime();
        $in3Weeks->modify('+21days');
        
        $nextMonth = new \Datetime();
        $nextMonth->modify('+1month');
        $in2Months = new \Datetime();
        $in2Months->modify('+2months');
        $in3Months = new \Datetime();
        $in3Months->modify('+3months');
        
        return $this->render('FrontFrontBundle:Festival:calendar.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'nextEvents' => $nextEvents,
                    'startdate' => $this->startdate,
                    'MeaCities' => $MeaCities,
            'nextWeekend' => $nextWeekend,
            'in2Weeks' => $in2Weeks,
            'in3Weeks' => $in3Weeks,
            'nextMonth' => $nextMonth,
            'in2Months' => $in2Months,
            'in3Months' => $in3Months,
        ));
    }

}
