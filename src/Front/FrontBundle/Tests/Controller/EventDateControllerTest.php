<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventDateControllerTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $client;
    private $clientLogged;
    private $id_event = 8;
    private $event = null;
    private $eventDate = null;
    private $PHP_AUTH_USER = 'Jerome';
    private $PHP_AUTH_PW = '1234';
    private $date = null;
    private $datestop = null;

    public function __construct() {
        $this->client = static::createClient();
        $this->client->followRedirects();

        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));
        $this->clientLogged->followRedirects();

        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->findEvent();
        $this->deleteData();
        $this->date = date('Y-m-d');
        $this->datestop = date('Y-m-d', strtotime("+30 days"));;
    }

    private function findEvent() {
        $this->event = $this->em->getRepository('FrontFrontBundle:Event')->find($this->id_event);
    }
    
    private function findEventDate(){
        $this->em->refresh($this->event);
        $eventDates = $this->event->getEventDates();
        $this->eventDate = $eventDates[0];
    }

    private function deleteData() {

        foreach ($this->event->getEventDates() as $eventDate)
            $this->em->remove($eventDate);

        $this->em->flush();
    }

    public function testNewWithClient() {

        $crawler = $this->clientLogged->request('GET', '/eventdate/' . $this->event->getId() . '/new');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains('Add', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Add')->form();

        $form['front_frontbundle_eventdate[startdate]'] = $this->date;
        $form['front_frontbundle_eventdate[starttime][hour]'] = 20;
        $form['front_frontbundle_eventdate[starttime][minute]'] = 30;
        $form['front_frontbundle_eventdate[stopdate]'] = $this->date;
        $form['front_frontbundle_eventdate[stoptime][hour]'] = "";
        $form['front_frontbundle_eventdate[stoptime][minute]'] = "";

        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        
        $this->em->refresh($this->event);
        $this->assertFalse($this->event->hasEventDateForDate($this->date));
    }

    public function testNewWithClientLogged() {

        $crawler = $this->clientLogged->request('GET', '/eventdate/' . $this->event->getId() . '/new');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains('Add', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Add')->form();

        $form['front_frontbundle_eventdate[startdate]'] = $this->date;
        $form['front_frontbundle_eventdate[starttime][hour]'] = 20;
        $form['front_frontbundle_eventdate[starttime][minute]'] = 30;
        $form['front_frontbundle_eventdate[stopdate]'] = $this->date;
        $form['front_frontbundle_eventdate[stoptime][hour]'] = "";
        $form['front_frontbundle_eventdate[stoptime][minute]'] = "";

        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        
        $this->em->refresh($this->event);
        $this->assertTrue($this->event->hasEventDateForDate($this->date));
    }
    
    public function testUpdateWithClient() {

        $this->findEventDate();
        $this->assertNotNull($this->eventDate);

        $crawler = $this->clientLogged->request('GET', '/eventdate/' . $this->eventDate->getId() . '/edit');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains('Update', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Update')->form();

        $form['front_frontbundle_eventdate[startdate]'] = $this->date;
        $form['front_frontbundle_eventdate[starttime][hour]'] = 20;
        $form['front_frontbundle_eventdate[starttime][minute]'] = 30;
        $form['front_frontbundle_eventdate[stopdate]'] = $this->date;
        $form['front_frontbundle_eventdate[stoptime][hour]'] = 21;
        $form['front_frontbundle_eventdate[stoptime][minute]'] = 12;

        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $this->em->refresh($this->event);
        $this->assertTrue($this->event->hasEventDateForDate($this->date));
        
        $this->em->refresh($this->eventDate);
        $this->assertNull($this->eventDate->getStopTime());
    }

    public function testUpdateWithClientLogged() {

        $this->findEventDate();
        $this->assertNotNull($this->eventDate);

        $crawler = $this->clientLogged->request('GET', '/eventdate/' . $this->eventDate->getId() . '/edit');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains('Update', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Update')->form();

        $form['front_frontbundle_eventdate[startdate]'] = $this->date;
        $form['front_frontbundle_eventdate[starttime][hour]'] = 20;
        $form['front_frontbundle_eventdate[starttime][minute]'] = 30;
        $form['front_frontbundle_eventdate[stopdate]'] = $this->date;
        $form['front_frontbundle_eventdate[stoptime][hour]'] = 22;
        $form['front_frontbundle_eventdate[stoptime][minute]'] = 45;

        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->em->refresh($this->event);
        $this->assertTrue($this->event->hasEventDateForDate($this->date));
        
        $this->em->refresh($this->eventDate);
        $this->assertEquals($this->date, $this->eventDate->getStopDate()->format('Y-m-d'));
        $this->assertEquals('22:45', $this->eventDate->getStopTime()->format('H:i'));
        $this->assertEquals('20:30', $this->eventDate->getStartTime()->format('H:i'));
    }

    public function testDeleteWithClient() {
        
        $this->findEventDate();
        $this->assertNotNull($this->eventDate);

        $crawler = $this->clientLogged->request('GET', '/event/' . $this->event->getURI() . '/' . $this->event->getId());
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $form = $crawler->filter('form[action="/eventdate/' . $this->eventDate->getId() . '/delete"]')->form();
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $this->em->refresh($this->event);
        $this->assertTrue($this->event->hasEventDateForDate($this->date));
    }

    public function testDeleteWithClientLogged() {
        
        $this->findEventDate();
        $this->assertNotNull($this->eventDate);

        $crawler = $this->clientLogged->request('GET', '/event/' . $this->event->getURI() . '/' . $this->event->getId());
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $form = $crawler->filter('form[action="/eventdate/' . $this->eventDate->getId() . '/delete"]')->form();
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->em->refresh($this->event);
        $this->assertFalse($this->event->hasEventDateForDate($this->date));
    }
    
    public function testAddByWeekdayWithClient() {

        $this->deleteData();
        $this->em->refresh($this->event);
        
        $crawler = $this->clientLogged->request('GET', '/eventdate/' . $this->event->getId() . '/add_by_weekday');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains('Add', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Add')->form();

        $form['form[stopdate]'] = $this->datestop;
        $form['form[weekday][1]']->tick();
        $form['form[time][hour]'] = 20;
        $form['form[time][minute]'] = 30;

        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        
        $this->em->refresh($this->event);
        $this->assertEquals(0, count($this->event->getEventDates()));
    }
    
    public function testAddByWeekdayWithClientLogged() {

        $this->deleteData();
        $this->em->refresh($this->event);
        
        $crawler = $this->clientLogged->request('GET', '/eventdate/' . $this->event->getId() . '/add_by_weekday');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains('Add', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Add')->form();

        $form['form[stopdate]'] = $this->datestop;
        $form['form[weekday][1]']->tick();
        $form['form[time][hour]'] = 20;
        $form['form[time][minute]'] = 30;

        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        
        $this->em->refresh($this->event);
        $this->assertGreaterThan(0, count($this->event->getEventDates()));
    }
    
    

}
