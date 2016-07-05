<?php

namespace Api\ApiV1Bundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventEnControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'en';
    private $client;
    private $latitude = 50.62925;
    private $longitude = 3.057256;

    public function __construct() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->client = static::createClient();

        $this->router = $this->client->getContainer()->get('router');
        $this->translator = $this->client->getContainer()->get('translator');
    }

    private function findEvents() {
        return $this->em->getRepository('FrontFrontBundle:Event')->findBy(array(), null, 5);
    }

    public function testGetEvent() {
        foreach ($this->findEvents() as $Event) {
            $crawler = $this->client->request('GET', $this->router->generate('apiv1_get_event', array(
                        '_locale' => $this->locale,
                        '_format' => 'xml',
                        'id' => $Event->getId(),
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
        }
    }

    public function testGetEvents() {
        $date = new \DateTime();
        for ($i = 0; $i < 10; $i++) {
            $crawler = $this->client->request('GET', $this->router->generate('apiv1_get_events', array(
                        '_locale' => $this->locale,
                        '_format' => 'xml',
                        'latitude' => $this->latitude,
                        'longitude' => $this->longitude,
                        'day' => $date->format('Y-m-d'),
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $date->add(new \DateInterval('P1D'));
        }
    }

}
