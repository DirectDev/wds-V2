<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $client;
    private $clientLogged;
    private $title = 'DURSIN SALSA, BACHATA & KIZ PARTY TEST';
    private $description = 'my description';
    private $updated_description = 'my description updated';
    private $PHP_AUTH_USER = 'Jerome';
    private $PHP_AUTH_PW = '1234';

    public function __construct() {
        $this->client = static::createClient();
        $this->client->followRedirects();

        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));

        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->deleteData();
    }

    private function findEvent() {
        $event = $this->em->getRepository('FrontFrontBundle:Event')->findOneBy(
                array(
                    'name' => \Front\FrontBundle\Controller\EventController::slugify($this->title),
                )
        );
        return $event;
    }
    
    private function findEvents() {
        $events = $this->em->getRepository('FrontFrontBundle:Event')->findBy(
                array(
                    'name' => \Front\FrontBundle\Controller\EventController::slugify($this->title),
                )
        );
        return $events;
    }

    private function deleteData() {

        $events = $this->findEvents();
        foreach ($events as $event)
            $this->em->remove($event);

        $this->em->flush();
    }
    
    public function testIndex() {

        $crawler = $this->client->request('GET', '/event/');
        $this->assertFalse($this->client->getResponse()->isSuccessful());
        
        $crawler = $this->clientLogged->request('GET', '/event/');
        $this->assertFalse($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testNewWithClient() {

        $crawler = $this->client->request('GET', '/event/new');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(
                0, $crawler->filter('html:contains("New event")')->count()
        );

        $crawler = $this->clientLogged->request('GET', '/event/new');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("New event")')->count()
        );

        $this->assertContains('Create', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Create')->form();

        $count_musicTypes = count($this->em->getRepository('FrontFrontBundle:MusicType')->findAll());
        for ($i = 0; $i < $count_musicTypes; $i++)
            $form['front_frontbundle_event[musicTypes][' . $i . ']']->tick();

        $form['front_frontbundle_event[eventType]']->select('1');
        $form['front_frontbundle_event[translations][en][title]'] = $this->title;
        $form['front_frontbundle_event[translations][en][description]'] = $this->description;

        $crawler = $this->client->submit($form);

        $response = $this->client->getResponse();

        $this->assertNull($this->findEvent());
    }

    public function testNewWithClientLogged() {

        $crawler = $this->clientLogged->request('GET', '/event/new');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("New event")')->count()
        );

        $this->assertContains('Create', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Create')->form();

        $count_musicTypes = count($this->em->getRepository('FrontFrontBundle:MusicType')->findAll());
        for ($i = 0; $i < $count_musicTypes; $i++)
            $form['front_frontbundle_event[musicTypes][' . $i . ']']->tick();

        $form['front_frontbundle_event[eventType]']->select('1');
        $form['front_frontbundle_event[translations][en][title]'] = $this->title;
        $form['front_frontbundle_event[translations][en][description]'] = $this->description;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->assertNotNull($this->findEvent());
    }
    
    
    public function testUpdateWithClientLogged() {
        
        $event = $this->findEvent();
        $this->assertNotNull($event);

        $crawler = $this->clientLogged->request('GET', '/event/'.$event->getId().'/edit');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains('Update', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Update')->form();

        $count_musicTypes = count($this->em->getRepository('FrontFrontBundle:MusicType')->findAll());
        for ($i = 0; $i < $count_musicTypes; $i++)
            $form['front_frontbundle_event[musicTypes][' . $i . ']']->tick();

        $form['front_frontbundle_event[eventType]']->select('2');
        $form['front_frontbundle_event[translations][en][title]'] = $this->title;
        $form['front_frontbundle_event[translations][en][description]'] = $this->updated_description;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($event);
        $this->assertEquals($this->updated_description, $event->getDescription());        

    }

    public function testShowWithClient() {

        $events = $this->em->getRepository('FrontFrontBundle:Event')->findAll();

        foreach ($events as $event) {

            $uri = $event->getURI();

            $crawler = $this->client->request('GET', '/event/' . $uri . '/' . $event->getId());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $this->assertGreaterThan(
                    0, $crawler->filter('html:contains("Description")')->count()
            );
        }
    }

    public function testShowWithClientLogged() {

        $events = $this->em->getRepository('FrontFrontBundle:Event')->findAll();

        foreach ($events as $event) {

            $uri = $event->getURI();

            $crawler = $this->clientLogged->request('GET', '/event/' . $uri . '/' . $event->getId());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
            $this->assertGreaterThan(
                    0, $crawler->filter('html:contains("Description")')->count()
            );
        }
    }
    
    public function testAlertsWithClientLogged() {
        
        $event = $this->findEvent();
        $this->assertNotNull($event);

        $crawler = $this->clientLogged->request('GET', '/event/'.$event->getId().'/alerts');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());      

    }

}
