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
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_calendar')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_dancer')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_teacher')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_artist')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_introduction')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_festival')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_photo')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_video')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city_music')));
    }

}
