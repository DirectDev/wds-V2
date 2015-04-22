<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CityControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $client;

    public function __construct() {
        $this->client = static::createClient();
        $this->client->followRedirects();

        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
    }

    public function testIndex() {
        $crawler = $this->client->request('GET', '/city/');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

}
