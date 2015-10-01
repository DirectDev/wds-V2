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
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findByName('Lesson')));
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findByName('Show')));
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findByName('Concert')));
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:EventType')->findByName('Workshop_Party')));
    }

    public function testPage() {
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('home')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('city')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('policy')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('calendar')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('dancers')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('teachers')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('artists')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('introductions')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('festivals')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('photos')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('videos')));
        $this->assertEquals(1, count($this->em->getRepository('AdminAdminBundle:Page')->findByName('musics')));
    }

}
