<?php

namespace Contact\ContactBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $client;

    /**
     * {@inheritDoc}
     */
    public function setUp() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
        $this->client = static::createClient();
    }

    public function testContact() {
        $crawler = $this->client->request('GET', '/contact/en');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertContains('contact', strtolower($crawler->filter('title')->text()));
    }

}
