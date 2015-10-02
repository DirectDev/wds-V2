<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CityControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
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
        $this->client->followRedirects();

        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));
    }

    private function findCities() {
        return $this->em->getRepository('FrontFrontBundle:City')->findAll();
    }

    public function testCalendar() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/calendar/' . $City->getName());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/calendar/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testTeachers() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/teachers/' . $City->getName());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/teachers/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testArtists() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/artists/' . $City->getName());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/artists/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testDancers() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/dancers/' . $City->getName());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/dancers/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testFestivals() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/festivals/' . $City->getName());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/festivals/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testIntroductions() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/introductions/' . $City->getName());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/introductions/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testShows() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/shows/' . $City->getName());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/shows/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testParties() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/parties/' . $City->getName());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/parties/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testBars() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/bars/' . $City->getName());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/bars/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testConcerts() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/concerts/' . $City->getName());
            var_dump($this->client->getResponse()->getContent());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/concerts/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testWorkshops() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/workshops/' . $City->getName());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/workshops/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testPhotos() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/photos/' . $City->getName());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/photos/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testMusics() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/musics/' . $City->getName());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/musics/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testVideos() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/videos/' . $City->getName());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/videos/' . $City->getName());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

}
