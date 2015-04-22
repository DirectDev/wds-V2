<?php

namespace Search\SearchBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontSearchControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $client;
    private $clientLogged;

    public function __construct() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->client = static::createClient();
        $this->client->followRedirects();
        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => 'Jerome',
                    'PHP_AUTH_PW' => '1234'
        ));
    }

    public function testEventFrontSearchWithClient() {

        $crawler = $this->client->request('GET', '/front/search/event');
        $this->assertFalse($this->client->getResponse()->isSuccessful());

        $cities = $this->em->getRepository('FrontFrontBundle:City')->findAll();
        foreach ($cities as $city) {
            $crawler = $this->client->request('GET', '/front/search/event?searchcity=' . urlencode($city->getSearchCity()) . '&searcheventdate=' . date('Y-m-d'));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $this->assertContains($this->stripAccents($city->getSearchCity()), $this->stripAccents($crawler->filter('title')->text()));
        }

        $crawler = $this->client->request('GET', '/front/search/event');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
    
    public function testEventFrontSearchWithClientLogged() {

        $this->clientLogged->followRedirects();
        
        $crawler = $this->clientLogged->request('GET', '/front/search/event');
        $this->assertFalse($this->clientLogged->getResponse()->isSuccessful());

        $cities = $this->em->getRepository('FrontFrontBundle:City')->findAll();
        foreach ($cities as $city) {
            $crawler = $this->clientLogged->request('GET', '/front/search/event?searchcity=' . urlencode($city->getSearchCity()) . '&searcheventdate=' . date('Y-m-d'));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
            $this->assertContains($this->stripAccents($city->getSearchCity()), $this->stripAccents($crawler->filter('title')->text()));
        }

        $crawler = $this->clientLogged->request('GET', '/front/search/event');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    private function stripAccents($string) {
        return strtolower(strtr($string, 'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'));
    }

}
