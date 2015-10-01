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
            $crawler = $this->client->request('GET', '/calendar/' . $City->getSearchCity());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/calendar/' . $City->getSearchCity());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testTeachers() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/teachers/' . $City->getSearchCity());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/teachers/' . $City->getSearchCity());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testArtists() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/artists/' . $City->getSearchCity());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/artists/' . $City->getSearchCity());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testDancers() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/dancers/' . $City->getSearchCity());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/dancers/' . $City->getSearchCity());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testFestivals() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/festivals/' . $City->getSearchCity());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/festivals/' . $City->getSearchCity());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testIntroductions() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/introductions/' . $City->getSearchCity());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/introductions/' . $City->getSearchCity());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testConcerts() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/concerts/' . $City->getSearchCity());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/concerts/' . $City->getSearchCity());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testWorkshops() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/workshops/' . $City->getSearchCity());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/workshops/' . $City->getSearchCity());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testPhotos() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/photos/' . $City->getSearchCity());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/photos/' . $City->getSearchCity());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testMusics() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/musics/' . $City->getSearchCity());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/musics/' . $City->getSearchCity());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testVideos() {
        foreach ($this->findCities() as $City) {
            $crawler = $this->client->request('GET', '/city/videos/' . $City->getSearchCity());
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $crawler = $this->clientLogged->request('GET', '/city/videos/' . $City->getSearchCity());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

}
