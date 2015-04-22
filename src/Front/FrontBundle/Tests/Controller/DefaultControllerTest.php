<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $client;
    private $clientLogged;

    public function __construct() {
        $this->client = static::createClient();
        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => 'Jerome',
                    'PHP_AUTH_PW' => '1234'
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function setUp() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
    }

    public function testIndex() {
        $crawler = $this->client->request('GET', '/');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertTrue($crawler->filter('h1')->count() > 0);
        $this->assertTrue($crawler->filter('h1')->text() == "More about WeDanceSalsa");
        
        $crawler = $this->clientLogged->request('GET', '/');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertTrue($crawler->filter('h1')->count() > 0);
        $this->assertTrue($crawler->filter('h1')->text() == "More about WeDanceSalsa");
    }

    public function testCity() {

        $city = 'lille';
        
        $crawler = $this->client->request('GET', '/city/' . $city);
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertTrue($crawler->filter('h1')->count() > 0);
        $this->assertContains($city, strtolower($crawler->filter('title')->text()));
        
        $crawler = $this->clientLogged->request('GET', '/city/' . $city);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertTrue($crawler->filter('h1')->count() > 0);
        $this->assertContains($city, strtolower($crawler->filter('title')->text()));
    }

    public function testPolicy() {
        $crawler = $this->client->request('GET', '/policy');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertTrue($crawler->filter('h1')->count() > 0);
        
        $crawler = $this->clientLogged->request('GET', '/policy');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertTrue($crawler->filter('h1')->count() > 0);
    }

    public function testFilterListByMusicType() {
        $crawler = $this->client->request('POST', '/filter/musictypelist');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        
        $crawler = $this->clientLogged->request('POST', '/filter/musictypelist');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testFilterMapByMusicType() {
        $crawler = $this->client->request('POST', '/filter/musictypemap');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertTrue($crawler->filter('#map-canvas-home')->count() > 0);
        
        $crawler = $this->clientLogged->request('POST', '/filter/musictypemap');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertTrue($crawler->filter('#map-canvas-home')->count() > 0);
    }
    
    public function testFilterListByEventType() {
        $crawler = $this->client->request('POST', '/filter/eventtypelist');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        
        $crawler = $this->clientLogged->request('POST', '/filter/eventtypelist');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testFilterMapByEventType() {
        $crawler = $this->client->request('POST', '/filter/eventtypemap');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertTrue($crawler->filter('#map-canvas-home')->count() > 0);
        
        $crawler = $this->clientLogged->request('POST', '/filter/eventtypemap');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertTrue($crawler->filter('#map-canvas-home')->count() > 0);
    }

}
