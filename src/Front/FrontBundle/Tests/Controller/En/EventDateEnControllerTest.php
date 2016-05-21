<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventDateEnControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'en';
    private $client;
    private $clientLogged;
    private $PHP_AUTH_USER = 'marie';
    private $PHP_AUTH_PW = '1234';
    private $date = null;
    private $datestop = null;

    public function __construct() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->client = static::createClient();

        $this->router = $this->client->getContainer()->get('router');
        $this->translator = $this->client->getContainer()->get('translator');

        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));

        $this->deleteData();
        $this->date = date('Y-m-d');
        $this->datestop = date('Y-m-d', strtotime("+30 days"));
        ;
    }

    private function findOneEvent() {
        foreach ($this->findUserLoggued()->getEvents() as $event)
            return $event;
    }

    private function findUserLoggued() {
        return $this->em->getRepository('UserUserBundle:User')->findOneBy(
                        array(
                            'username' => $this->PHP_AUTH_USER,
                        )
        );
    }

    private function findEventDate() {
        $event = $this->findOneEvent();
        $this->em->refresh($event);
        $eventDates = $event->getEventDates();
        return $eventDates[0];
    }

    private function deleteData() {
        $event = $this->findOneEvent();
        foreach ($event->getEventDates() as $eventDate)
            $this->em->remove($eventDate);

        $this->em->flush();
    }

    private function findAllEventDates() {
        return $this->em->getRepository('FrontFrontBundle:EventDate')->findAll();
    }

    public function testNewAnonymous() {

        $event = $this->findOneEvent();
        $crawler = $this->client->request('GET', $this->router->generate('front_eventdate_new', array(
                    'id' => $event->getId(),
                    '_locale' => $this->locale
                        )
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }

    public function testNewByEventLogged() {

        $event = $this->findOneEvent();
        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_eventdate_new', array(
                    'id' => $event->getId(),
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testCreateUpdateLogged() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('front.add_date', array(), 'messages', $this->locale);
        $event = $this->findOneEvent();

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_eventdate_new', array(
                    'id' => $event->getId(),
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->filter('form[name="ffed"]')->form();

        $form['ffed[startdate]'] = $this->date;
        $form['ffed[starttime][hour]'] = 20;
        $form['ffed[starttime][minute]'] = 30;
        $form['ffed[stopdate]'] = $this->date;
        $form['ffed[stoptime][hour]'] = "";
        $form['ffed[stoptime][minute]'] = "";

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($event);
        $this->assertTrue($event->hasEventDateForDate($this->date));

        /*         * **** Update ***** */
        $eventDate = $this->findEventDate();
        $update = $this->translator->trans('Update', array(), 'messages', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_eventdate_edit', array(
                    '_locale' => $this->locale,
                    'id' => $eventDate->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->filter('form[name="ffed"]')->form();

        $form['ffed[startdate]'] = $this->date;
        $form['ffed[starttime][hour]'] = 20;
        $form['ffed[starttime][minute]'] = 30;
        $form['ffed[stopdate]'] = $this->date;
        $form['ffed[stoptime][hour]'] = 21;
        $form['ffed[stoptime][minute]'] = 12;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($eventDate);
        $this->assertEquals($this->date, $eventDate->getStopDate()->format('Y-m-d'));
        $this->assertEquals('21:12', $eventDate->getStopTime()->format('H:i'));
        $this->assertEquals('20:30', $eventDate->getStartTime()->format('H:i'));
    }

    public function testAddByWeekdayLogged() {

//        $this->deleteData();
        $event = $this->findOneEvent();
        $count = count($event->getEventDates());
        $add = $this->translator->trans('front.add_weekly_date', array(), 'messages', $this->locale);


        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_eventdate_add_by_weekday', array(
                    '_locale' => $this->locale,
                    'id' => $event->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($add, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($add)->form();

        $form['form[stopdate]'] = $this->datestop;
        $form['form[weekday][1]']->tick();
        $form['form[time][hour]'] = 20;
        $form['form[time][minute]'] = 30;

        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->em->refresh($event);
        $this->assertGreaterThan($count, count($event->getEventDates()));
    }

    public function testDeleteAnonymous() {

        $eventDate = $this->findEventDate();
        $this->assertNotNull($eventDate);
        $event = $eventDate->getEvent();
        $count = count($event->getEventDates());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_eventdate_show_tagbox', array(
                    'id' => $eventDate->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $form = $crawler->filter('form[name="form"]')->form();
        $crawler = $this->client->submit($form);
        $this->assertFalse($this->client->getResponse()->isSuccessful());

        $this->em->refresh($event);
        $this->assertEquals($count, count($event->getEventDates()));
    }

    public function testDeleteLogged() {

        $eventDate = $this->findEventDate();
        $this->assertNotNull($eventDate);
        $event = $eventDate->getEvent();
        $count = count($event->getEventDates());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_eventdate_show_tagbox', array(
                    'id' => $eventDate->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $form = $crawler->filter('form[name="form"]')->form();
        $crawler = $this->clientLogged->submit($form);
        $this->clientLogged->followRedirect();
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->em->refresh($event);
        $this->assertLessThan($count, count($event->getEventDates()));
    }

    public function testShow() {
        $eventDates = $this->findAllEventDates();
        foreach ($eventDates as $eventDate) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_eventdate_show', array(
                        'id' => $eventDate->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testShowTagbox() {
        $eventDates = $this->findAllEventDates();
        foreach ($eventDates as $eventDate) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_eventdate_show_tagbox', array(
                        'id' => $eventDate->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

}
