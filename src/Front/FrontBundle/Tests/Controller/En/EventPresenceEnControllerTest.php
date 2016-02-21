<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventFrControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'en';
    private $client;
    private $clientLogged;
    private $PHP_AUTH_USER = 'Jerome';
    private $PHP_AUTH_PW = '1234';

    public function __construct() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->client = static::createClient();

        $this->router = $this->client->getContainer()->get('router');
        $this->translator = $this->client->getContainer()->get('translator');

        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));

        $this->deleteData();
    }

    private function findOneEvent() {
        $i = 0;
        foreach ($this->findAllEvents() as $event) {
            $i++;
            if ($i == 1)
                continue;
            return $event;
        }
    }

    private function findAllEvents() {
        return $this->em->getRepository('FrontFrontBundle:Event')->findAll();
    }

    private function deleteData() {

        $Event = $this->findOneEvent();
        foreach ($Event->getUserPresents() as $user) {
            $user->removeEventPresence($Event);
            $this->em->persist($user);
        }

        $this->em->flush();
    }

    public function testPresence() {

        $event = $this->findOneEvent();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_eventpresence_presences', array(
                    'id' => $event->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $form = $crawler->filter('form[name="form"]')->form();
        $crawler = $this->clientLogged->submit($form);

        $this->clientLogged->followRedirect();
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->em->refresh($event);
        $this->assertEquals(1, count($event->getUserPresents()));
    }

    public function testUnpresence() {

        $event = $this->findOneEvent();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_eventpresence_presences', array(
                    'id' => $event->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $form = $crawler->filter('form[name="form"]')->form();
        $crawler = $this->clientLogged->submit($form);

        $this->clientLogged->followRedirect();
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->em->refresh($event);
        $this->assertEquals(0, count($event->getUserPresents()));
    }

    public function testPresences() {
        $event = $this->findOneEvent();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_eventpresence_presences', array(
                    'id' => $event->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

}
