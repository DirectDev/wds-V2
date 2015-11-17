<?php

namespace BackOfficeBundle\Tests\Fixtures\Fr;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FixturesEnTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $locale = 'en';

    public function __construct() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
    }

    public function testMusicTypes() {

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:MusicType')->findOneByName("Salsa")));
        $musicType = $this->em->getRepository('FrontFrontBundle:MusicType')->findOneByName("Salsa");
        $this->assertNotEmpty($musicType->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:MusicType')->findOneByName("Bachata")));
        $musicType = $this->em->getRepository('FrontFrontBundle:MusicType')->findOneByName("Bachata");
        $this->assertNotEmpty($musicType->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:MusicType')->findOneByName("Tango")));
        $musicType = $this->em->getRepository('FrontFrontBundle:MusicType')->findOneByName("Tango");
        $this->assertNotEmpty($musicType->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:MusicType')->findOneByName("Kizomba")));
        $musicType = $this->em->getRepository('FrontFrontBundle:MusicType')->findOneByName("Kizomba");
        $this->assertNotEmpty($musicType->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:MusicType')->findOneByName("Merengue")));
        $musicType = $this->em->getRepository('FrontFrontBundle:MusicType')->findOneByName("Merengue");
        $this->assertNotEmpty($musicType->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:MusicType')->findOneByName("Zouk")));
        $musicType = $this->em->getRepository('FrontFrontBundle:MusicType')->findOneByName("Zouk");
        $this->assertNotEmpty($musicType->translate($this->locale)->getTitle());
        
    }
    
    public function testEventTypes() {

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findOneByName("Party")));
        $eventType = $this->em->getRepository('FrontFrontBundle:EventType')->findOneByName("Party");
        $this->assertNotEmpty($eventType->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findOneByName("Festival")));
        $eventType = $this->em->getRepository('FrontFrontBundle:EventType')->findOneByName("Festival");
        $this->assertNotEmpty($eventType->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findOneByName("Workshop")));
        $eventType = $this->em->getRepository('FrontFrontBundle:EventType')->findOneByName("Workshop");
        $this->assertNotEmpty($eventType->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findOneByName("Introduction")));
        $eventType = $this->em->getRepository('FrontFrontBundle:EventType')->findOneByName("Introduction");
        $this->assertNotEmpty($eventType->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findOneByName("Show")));
        $eventType = $this->em->getRepository('FrontFrontBundle:EventType')->findOneByName("Show");
        $this->assertNotEmpty($eventType->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findOneByName("Concert")));
        $eventType = $this->em->getRepository('FrontFrontBundle:EventType')->findOneByName("Concert");
        $this->assertNotEmpty($eventType->translate($this->locale)->getTitle());

    }

}
