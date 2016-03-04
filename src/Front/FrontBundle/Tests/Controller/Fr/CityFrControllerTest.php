<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CityFrControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'fr';
    private $client;
    private $clientLogged;
    private $PHP_AUTH_USER = 'Jerome';
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
    }

    private function findCities() {
        return $this->em->getRepository('FrontFrontBundle:City')->findBy(array(), null, 10);
    }

    public function testEdito() {
        foreach ($this->findCities() as $City) {
            if(!$City->hasEdito())
                continue;
            
            $crawler = $this->client->request('GET', $this->router->generate('city_edito', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_edito', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }
    
    public function testCalendar() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_calendar', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_calendar', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testTeachers() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_teacher', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_teacher', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testArtists() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_artist', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_artist', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testDancers() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_dancer', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_dancer', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testFestivals() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_festival', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_festival', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testIntroductions() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_introduction', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_introduction', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testShows() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_show', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_show', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testParties() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_party', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_party', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testBars() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_bar', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_bar', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testConcerts() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_concert', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_concert', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testWorkshops() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_workshop', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_workshop', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testPhotos() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_photo', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_photo', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testMusics() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_music', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_music', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testVideos() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_video', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_video', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testNumbers() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', $this->router->generate('city_number', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', $this->router->generate('city_number', array(
                        '_locale' => $this->locale,
                        'searchcity' => $City->getName()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

}
