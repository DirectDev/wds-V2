<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'en';
    private $clientLogged;
    private $PHP_AUTH_USER = 'Jerome';
    private $PHP_AUTH_PW = '1234';
    private $title;
    private $description;
    private $updated_description;
    private $facebook_link;

    public function __construct() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));

        $this->router = $this->clientLogged->getContainer()->get('router');
        $this->translator = $this->clientLogged->getContainer()->get('translator');

        $this->title = 'title_' . $this->locale;
        $this->description = 'description_' . $this->locale;
        $this->updated_description = 'updated_description_' . $this->locale;
        $this->facebook_link = 'http://facebook.com';

        $this->deleteData();
    }

    private function deleteData() {
        if ($event = $this->findEvent())
            $this->em->remove($event);

        $this->em->flush();
    }

    private function findAllEvents() {
        return $this->em->getRepository('FrontFrontBundle:Event')->findBy(array(), null, 5);
    }

    private function findOneEvent() {
        foreach ($this->findAllEvents() as $event)
            return $event;
    }

    private function findEvent() {
        $event = $this->em->getRepository('FrontFrontBundle:Event')->findOneBy(
                array(
                    'name' => \Front\FrontBundle\Controller\EventController::slugify($this->title),
                )
        );
        return $event;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_event', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }
    
    public function testShow() {
        $events = $this->findAllEvents();
        foreach ($events as $event) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_event_show', array(
                        'id' => $event->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_event_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $count_musicTypes = count($this->em->getRepository('FrontFrontBundle:MusicType')->findAll());
        for ($i = 0; $i < $count_musicTypes; $i++)
            $form['aab_event[musicTypes][' . $i . ']']->tick();
        $count_eventTypes = count($this->em->getRepository('FrontFrontBundle:EventType')->findAll());
        for ($i = 0; $i < $count_eventTypes; $i++)
            $form['aab_event[eventTypes][' . $i . ']']->tick();
        if (rand(0, 1))
            $form['aab_event[published]']->tick();

        $form['aab_event[name]'] = \Front\FrontBundle\Controller\EventController::slugify($this->title);
        $form['aab_event[translations][' . $this->locale . '][title]'] = $this->title;
        $form['aab_event[translations][' . $this->locale . '][description]'] = $this->description;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        var_dump($response->getContent());

        $event = $this->findEvent();
        $this->assertNotNull($event);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_event_edit', array(
                    '_locale' => $this->locale,
                    'id' => $event->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_event[translations][' . $this->locale . '][description]'] = $this->updated_description;
        
        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($event);
        $this->assertEquals($this->updated_description, $event->getDescription());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $event = $this->findOneEvent();
        $this->assertNotNull($event);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_event_edit', array(
                    '_locale' => $this->locale,
                    'id' => $event->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('FrontFrontBundle:Event')->findOneById($event->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals(($count_events_before - 1), $count_events_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
