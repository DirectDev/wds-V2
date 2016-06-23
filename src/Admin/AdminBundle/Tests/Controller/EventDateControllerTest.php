<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventDateControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'en';
    private $clientLogged;
    private $PHP_AUTH_USER = 'jerome';
    private $PHP_AUTH_PW = '1234';
    private $date = null;
    private $dateStop = null;

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

        $this->date = new \DateTime();
        $this->dateStop = new \DateTime();
        $this->dateStop->modify('+30 days');

        $this->deleteData();
    }

    private function findOneEvent() {
        foreach ($this->findUserLoggued()->getEvents() as $event)
            return $event;
    }

    private function findUserLoggued() {
        return $this->em->getRepository('UserUserBundle:User')->findOneBy(
                        array(
                            'username' => 'marie',
                        )
        );
    }

    private function findEventDate() {
        $event = $this->findOneEvent();
        $this->em->refresh($event);
        $eventDates = $event->getEventDates();
        return $eventDates[0];
    }

    private function deleteData() {
        $event = $this->findOneEvent();
        foreach ($event->getEventDates() as $eventDate)
            $this->em->remove($eventDate);

        $this->em->flush();
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_eventdate', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }
    
    public function testShow() {
        $eventDates = $this->findAllEventDates();
        foreach ($eventDates as $eventDate) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_eventdate_show', array(
                        'id' => $eventDate->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testCreateUpdate() {

        $event = $this->findOneEvent();

        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_eventdate_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_eventdate[startdate][year]'] = $this->date->format('Y');
        $form['aab_eventdate[startdate][month]'] = $this->date->format("n");
        $form['aab_eventdate[startdate][day]'] = $this->date->format('j');
        $form['aab_eventdate[starttime][hour]'] = 20;
        $form['aab_eventdate[starttime][minute]'] = 30;
        $form['aab_eventdate[stopdate][year]'] = $this->dateStop->format('Y');
        $form['aab_eventdate[stopdate][month]'] = $this->dateStop->format("n");
        $form['aab_eventdate[stopdate][day]'] = $this->dateStop->format('j');
        $form['aab_eventdate[stoptime][hour]'] = "";
        $form['aab_eventdate[stoptime][minute]'] = "";
        $form['aab_eventdate[events]'] = $event->getId();

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        var_dump($response->getContent());


        $this->em->refresh($event);
        $this->assertTrue($event->hasEventDateForDate($this->date->format('Y-m-d')));

        $eventDate = $this->findEventDate();
        $this->assertNotNull($eventDate);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_eventdate_edit', array(
                    '_locale' => $this->locale,
                    'id' => $eventDate->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_eventdate[startdate][year]'] = $this->date->format('Y');
        $form['aab_eventdate[startdate][month]'] = $this->date->format("n");
        $form['aab_eventdate[startdate][day]'] = $this->date->format('j');
        $form['aab_eventdate[starttime][hour]'] = 20;
        $form['aab_eventdate[starttime][minute]'] = 30;
        $form['aab_eventdate[stopdate][year]'] = $this->dateStop->format('Y');
        $form['aab_eventdate[stopdate][month]'] = $this->dateStop->format("n");
        $form['aab_eventdate[stopdate][day]'] = $this->dateStop->format('j');
        $form['aab_eventdate[stoptime][hour]'] = 21;
        $form['aab_eventdate[stoptime][minute]'] = 12;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($eventDate);
        $this->assertEquals($this->date->format('Y-m-d'), $eventDate->getStartDate()->format('Y-m-d'));
        $this->assertEquals($this->dateStop->format('Y-m-d'), $eventDate->getStopDate()->format('Y-m-d'));
        $this->assertEquals('21:12', $eventDate->getStopTime()->format('H:i'));
        $this->assertEquals('20:30', $eventDate->getStartTime()->format('H:i'));
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_event_dates_before = $this->em->getRepository('FrontFrontBundle:EventDate')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $eventDate = $this->findEventDate();
        $this->assertNotNull($eventDate);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_eventdate_edit', array(
                    '_locale' => $this->locale,
                    'id' => $eventDate->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('FrontFrontBundle:EventDate')->findOneById($eventDate->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_event_dates_after = $this->em->getRepository('FrontFrontBundle:EventDate')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals($count_events_before, $count_events_after);
        $this->assertEquals(($count_event_dates_before - 1), $count_event_dates_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
