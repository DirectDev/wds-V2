<?php

namespace BackOfficeBundle\Tests\Fixtures\Fr;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FixturesFrTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $locale = 'fr';

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
    
    public function testTags() {

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Salsa")));
        $tag = $this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Salsa");
        $this->assertNotEmpty($tag->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Bachata")));
        $tag = $this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Bachata");
        $this->assertNotEmpty($tag->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Merengue")));
        $tag = $this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Merengue");
        $this->assertNotEmpty($tag->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Kizomba")));
        $tag = $this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Kizomba");
        $this->assertNotEmpty($tag->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("On1")));
        $tag = $this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("On1");
        $this->assertNotEmpty($tag->translate($this->locale)->getTitle());

        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("On2")));
        $tag = $this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("On2");
        $this->assertNotEmpty($tag->translate($this->locale)->getTitle());
        
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Cubana")));
        $tag = $this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Cubana");
        $this->assertNotEmpty($tag->translate($this->locale)->getTitle());
        
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Dominicana")));
        $tag = $this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Dominicana");
        $this->assertNotEmpty($tag->translate($this->locale)->getTitle());
        
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Beginner")));
        $tag = $this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Beginner");
        $this->assertNotEmpty($tag->translate($this->locale)->getTitle());
        
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Advanced")));
        $tag = $this->em->getRepository('FrontFrontBundle:Tag')->findOneByName("Advanced");
        $this->assertNotEmpty($tag->translate($this->locale)->getTitle());
    }

}
