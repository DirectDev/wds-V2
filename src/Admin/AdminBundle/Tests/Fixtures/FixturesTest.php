<?php

namespace Admin\AdmineBundle\Tests\Fixtures;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FixturesTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
    }

    public function testUserType() {
        $this->assertEquals(1, count($this->em->getRepository('UserUserBundle:UserType')->findByName('dancer')));
        $this->assertEquals(1, count($this->em->getRepository('UserUserBundle:UserType')->findByName('teacher')));
        $this->assertEquals(1, count($this->em->getRepository('UserUserBundle:UserType')->findByName('artist')));
        $this->assertEquals(1, count($this->em->getRepository('UserUserBundle:UserType')->findByName('bar')));
    }

    public function testEventType() {
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findByName('Party')));
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findByName('Festival')));
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findByName('Workshop')));
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findByName('Introduction')));
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findByName('Show')));
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findByName('Concert')));
    }

    public function testPage() {
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('home')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('policy')));

        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_edito')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_calendar')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_dancer')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_teacher')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_artist')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_introduction')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_festival')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_photo')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_video')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_music')));

        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_calendar')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_europe')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_north_america')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_central_america')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_south_america')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_north_africa')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_central_africa')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_south_africa')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_north_asia')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_south_asia')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_india')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_australia')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_indonesia')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festival_middle_east')));

        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('musics')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('videos')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('moves')));

        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('dance-salsa')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('dance-salsa-cubana')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('dance-salsa-on1')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('dance-salsa-on2')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('dance-salsa-dominicana')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('dance-salsa-rueda')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('dance-bachata')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('dance-bachata-moderna')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('dance-bachata-dominicana')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('dance-bachata-sensual')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('dance-kizomba')));

        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('learn-salsa')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('learn-bachata')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('learn-kizomba')));

        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('landing-dancer')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('landing-pro')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('landing-pub')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('landing-share-event')));
    }

}
