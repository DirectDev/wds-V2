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
    private $locale = 'fr';
    private $client;
    private $clientLogged;
    private $title;
    private $description;
    private $updated_description;
    private $facebook_link;
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

        $this->title = 'title_' . $this->locale;
        $this->description = 'description_' . $this->locale;
        $this->updated_description = 'updated_description_' . $this->locale;
        $this->facebook_link = 'http://facebook.com';

        $this->deleteData();
    }

    private function findEvent() {
        $event = $this->em->getRepository('FrontFrontBundle:Event')->findOneBy(
                array(
                    'name' => \Front\FrontBundle\Controller\EventController::slugify($this->title),
                )
        );
        return $event;
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

    private function findEvents() {
        $events = $this->em->getRepository('FrontFrontBundle:Event')->findBy(
                array(
                    'name' => \Front\FrontBundle\Controller\EventController::slugify($this->title),
                )
        );
        return $events;
    }

    private function findAllEvents() {
        return $this->em->getRepository('FrontFrontBundle:Event')->findAll();
    }

    private function deleteData() {

        $events = $this->findEvents();
        foreach ($events as $event)
            $this->em->remove($event);

        $this->em->flush();

        $Event = $this->findOneEvent();
        foreach ($Event->getLovesMe() as $user) {
            $user->removeEventLove($Event);
            $this->em->persist($user);
        }

        $Event = $this->findOneEvent();
        foreach ($Event->getUserPresents() as $user) {
            $user->removeEventPresence($Event);
            $this->em->persist($user);
        }

        $this->em->flush();
    }

    public function testNewAnonymous() {

        $crawler = $this->client->request('GET', $this->router->generate('front_event_new', array(
                    '_locale' => $this->locale)
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }

    public function testNewLogged() {

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_event_new', array(
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testCreateUpdateLogged() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('Create', array(), 'messages', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_event_new', array(
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->filter('form[name="ffe"]')->form();

        $count_musicTypes = count($this->em->getRepository('FrontFrontBundle:MusicType')->findAll());
        for ($i = 0; $i < $count_musicTypes; $i++)
            $form['ffe[musicTypes][' . $i . ']']->tick();
        $count_eventTypes = count($this->em->getRepository('FrontFrontBundle:EventType')->findAll());
        for ($i = 0; $i < $count_eventTypes; $i++)
            $form['ffe[eventTypes][' . $i . ']']->tick();
        if (rand(0, 1))
            $form['ffe[published]']->tick();

        $form['ffe[translations][' . $this->locale . '][title]'] = $this->title;
        $form['ffe[translations][' . $this->locale . '][description]'] = $this->description;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $event = $this->findEvent();
        $this->assertNotNull($event);


        /*         * **** Update ***** */
        $update = $this->translator->trans('Update', array(), 'messages', $this->locale);


        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_event_edit', array(
                    '_locale' => $this->locale,
                    'id' => $event->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->filter('form[enctype="multipart/form-data"]')->form();

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($event);


        /*         * **** Update description***** */
        $update = $this->translator->trans('Update', array(), 'messages', $this->locale);


        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_event_edit', array(
                    '_locale' => $this->locale,
                    'id' => $event->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->filter('form[name="ffede"]')->form();

        $count_musicTypes = count($this->em->getRepository('FrontFrontBundle:MusicType')->findAll());
        for ($i = 0; $i < $count_musicTypes; $i++)
            $form['ffede[musicTypes][' . $i . ']']->untick();
        $count_eventTypes = count($this->em->getRepository('FrontFrontBundle:EventType')->findAll());
        for ($i = 0; $i < $count_eventTypes; $i++)
            $form['ffede[eventTypes][' . $i . ']']->untick();
        if (rand(0, 1))
            $form['ffede[published]']->tick();

        $form['ffede[translations][' . $this->locale . '][title]'] = $this->title;
        $form['ffede[translations][' . $this->locale . '][description]'] = $this->updated_description;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($event);
        $this->assertEquals($this->updated_description, $event->getDescription());

        /*         * **** Update link***** */
        $update = $this->translator->trans('Update', array(), 'messages', $this->locale);


        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_event_edit', array(
                    '_locale' => $this->locale,
                    'id' => $event->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->filter('form[name="ffel"]')->form();

        $form['ffel[facebook_link]'] = $this->facebook_link;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($event);
        $this->assertEquals($this->facebook_link, $event->getFacebookLink());
    }

    public function testShowAnonymous() {
        $events = $this->em->getRepository('FrontFrontBundle:Event')->findAll();
        foreach ($events as $event) {
            $crawler = $this->client->request('GET', $this->router->generate('front_event_show', array(
                        '_locale' => $this->locale,
                        'uri' => $event->getURI(),
                        'id' => $event->getId()
            )));
            $this->assertTrue($this->client->getResponse()->isSuccessful());
        }
    }

    public function testShowLoggued() {
        $events = $this->em->getRepository('FrontFrontBundle:Event')->findAll();
        foreach ($events as $event) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_event_show', array(
                        '_locale' => $this->locale,
                        'uri' => $event->getURI(),
                        'id' => $event->getId()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testAlerts() {
        $events = $this->em->getRepository('FrontFrontBundle:Event')->findAll();
        foreach ($events as $event) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_event_alerts', array(
                        '_locale' => $this->locale,
                        'id' => $event->getId()
            )));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

}
