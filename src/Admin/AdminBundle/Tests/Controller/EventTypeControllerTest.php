<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventTypeControllerTest extends WebTestCase {

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
    private $name = null;
    private $updated_name = null;
    private $title = null;

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

        $this->name = '_admin_eventtype_name_' . $this->locale;
        $this->updated_name = $this->name . '_updated';
        $this->title = 'title';

        $this->deleteData();
    }

    private function deleteData() {
        if ($event_type = $this->findEventType())
            $this->em->remove($event_type);

        $this->em->flush();
    }

    private function findAllEventTypes() {
        return $this->em->getRepository('FrontFrontBundle:EventType')->findBy(array(), null, 5);
    }

    private function findOneEventType() {
        foreach ($this->findAllEventTypes() as $event_type)
            return $event_type;
    }

    private function findEventType() {
        $event_type = $this->em->getRepository('FrontFrontBundle:EventType')->findOneBy(
                array(
                    'name' => $this->name,
                )
        );
        if ($event_type)
            return $event_type;
        $event_type = $this->em->getRepository('FrontFrontBundle:EventType')->findOneBy(
                array(
                    'name' => $this->updated_name,
                )
        );
        if ($event_type)
            return $event_type;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_eventtype', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }
    
    public function testShow() {
        $eventTypes = $this->findAllEventTypes();
        foreach ($eventTypes as $eventType) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_eventtype_show', array(
                        'id' => $eventType->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_eventtype_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_eventtype[name]'] = $this->name;
        $form['aab_eventtype[translations][' . $this->locale . '][title]'] = $this->title;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        

        $event_type = $this->findEventType();
        $this->assertNotNull($event_type);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_eventtype_edit', array(
                    '_locale' => $this->locale,
                    'id' => $event_type->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_eventtype[name]'] = $this->updated_name;
        $form['aab_eventtype[translations][' . $this->locale . '][title]'] = $this->title;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($event_type);
        $this->assertEquals($this->updated_name, $event_type->getName());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_event_types_before = $this->em->getRepository('FrontFrontBundle:EventType')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $event_type = $this->findOneEventType();
        $this->assertNotNull($event_type);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_eventtype_edit', array(
                    '_locale' => $this->locale,
                    'id' => $event_type->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('FrontFrontBundle:EventType')->findOneById($event_type->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_event_types_after = $this->em->getRepository('FrontFrontBundle:EventType')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals($count_events_before, $count_events_after);
        $this->assertEquals(($count_event_types_before - 1), $count_event_types_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
