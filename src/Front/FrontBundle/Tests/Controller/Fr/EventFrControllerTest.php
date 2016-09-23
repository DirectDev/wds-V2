<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventFrControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'fr';
    private $client;
    private $clientLogged;
    private $title;
    private $description;
    private $updated_description;
    private $facebook_link;
    private $PHP_AUTH_USER = 'Marie';
    private $PHP_AUTH_PW = '1234';

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

        $this->title = 'title_' . $this->locale;
        $this->description = 'description_' . $this->locale;
        $this->updated_description = 'updated_description_' . $this->locale;
        $this->facebook_link = 'http://facebook.com';

    }


    public function testNewAnonymous() {

        $crawler = $this->client->request('GET', $this->router->generate('front_event_new', array(
                    '_locale' => $this->locale)
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }

    public function testNewLogged() {

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_event_new', array(
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testShowAnonymous() {
        $events = $this->em->getRepository('FrontFrontBundle:Event')->findAll();
        foreach ($events as $event) {
            $crawler = $this->client->request('GET', $this->router->generate('front_event_show', array(
                        '_locale' => $this->locale,
                        'uri' => $event->getURI(),
                        'id' => $event->getId()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
        }
    }

    public function testShowLoggued() {
        $events = $this->em->getRepository('FrontFrontBundle:Event')->findAll();
        foreach ($events as $event) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_event_show', array(
                        '_locale' => $this->locale,
                        'uri' => $event->getURI(),
                        'id' => $event->getId()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testAlerts() {
        $events = $this->em->getRepository('FrontFrontBundle:Event')->findAll();
        foreach ($events as $event) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_event_alerts', array(
                        '_locale' => $this->locale,
                        'id' => $event->getId()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

}
