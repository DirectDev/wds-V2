<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddressFrControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'fr';
    private $country_iso = 'fr';
    private $client;
    private $clientLogged;
    private $event_name = null;
    private $event_street = null;
    private $event_street_complement = null;
    private $event_postcode = null;
    private $event_city = null;
    private $event_country = null;
    private $user_name = null;
    private $user_street = null;
    private $user_street_complement = null;
    private $user_postcode = null;
    private $user_city = null;
    private $user_country = null;
    private $PHP_AUTH_USER = 'marie';
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

        $this->event_name = 'address_name_' . $this->locale;
        $this->updated_name = $this->event_name . '_updated';
        $this->event_street = 'street_' . $this->locale;
        $this->event_street_complement = 'street_complement_' . $this->locale;
        $this->event_city = 'Lille';
        $this->event_postcode = '59000';
        $this->event_country = $this->findCountry();
        $this->user_name = 'u_address_name_' . $this->locale;
        $this->updated_name = $this->user_name . '_updated';
        $this->user_street = 'u_street_' . $this->locale;
        $this->user_street_complement = 'u_street_complement_' . $this->locale;
        $this->user_city = 'Paris';
        $this->user_postcode = '75000';
        $this->user_country = $this->findCountry();

        $this->deleteData();
    }

    private function findCountry() {
        return $this->em->getRepository('FrontFrontBundle:Country')->findOneByIso2($this->country_iso);
    }

    private function findOneEvent() {
        foreach ($this->findUserLoggued()->getEvents() as $event)
            return $event;
    }

    private function findUserLoggued() {
        return $this->em->getRepository('UserUserBundle:User')->findOneBy(
                        array(
                            'username' => $this->PHP_AUTH_USER,
                        )
        );
    }

    private function findAllAddresses() {
        return $this->em->getRepository('FrontFrontBundle:Address')->findBy(array(), null, 10);
    }

    private function findEventAddress() {
        $address = $this->em->getRepository('FrontFrontBundle:Address')->findOneBy(
                array(
                    'city' => $this->event_city,
                    'street' => $this->event_street,
                    'country' => $this->event_country,
                )
        );
        return $address;
    }

    private function findUserAddress() {
        $address = $this->em->getRepository('FrontFrontBundle:Address')->findOneBy(
                array(
                    'city' => $this->user_city,
                    'street' => $this->user_street,
                    'country' => $this->user_country,
                )
        );
        return $address;
    }

    private function deleteData() {

        if ($address = $this->findEventAddress())
            $this->em->remove($address);

        if ($address = $this->findUserAddress())
            $this->em->remove($address);

        $this->em->flush();
    }

    public function testNewByEventAnonymous() {

        $event = $this->findOneEvent();
        $crawler = $this->client->request('GET', $this->router->generate('front_address_event_new', array(
                    'id' => $event->getId(),
                    '_locale' => $this->locale
                        )
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }

    public function testNewByEventLogged() {

        $event = $this->findOneEvent();
        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_address_event_new', array(
                    'id' => $event->getId(),
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testCreateUpdateByEventLogged() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('Create', array(), 'messages', $this->locale);
        $event = $this->findOneEvent();

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_address_event_new', array(
                    'id' => $event->getId(),
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->filter('form[name="ffa"]')->form();

        $form['ffa[name]'] = $this->event_name;
        $form['ffa[street]'] = $this->event_street;
        $form['ffa[streetComplement]'] = $this->event_street_complement;
        $form['ffa[postcode]'] = $this->event_postcode;
        $form['ffa[city]'] = $this->event_city;
        $form['ffa[country]'] = $this->event_country->getId();

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $address = $this->findEventAddress();
        $this->assertNotNull($address);

        /*         * **** Update ***** */
        $update = $this->translator->trans('Update', array(), 'messages', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_address_edit', array(
                    '_locale' => $this->locale,
                    'id' => $address->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->filter('form[name="ffa"]')->form();

        $form['ffa[name]'] = $this->updated_name;
        $form['ffa[street]'] = $this->event_street;
        $form['ffa[streetComplement]'] = $this->event_street_complement;
        $form['ffa[postcode]'] = $this->event_postcode;
        $form['ffa[city]'] = $this->event_city;
        $form['ffa[country]'] = $this->event_country->getId();

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($address);
        $this->assertEquals($this->updated_name, $address->getName());
    }

    public function testNewByUserAnonymous() {

        $user = $this->findUserLoggued();
        $crawler = $this->client->request('GET', $this->router->generate('front_address_user_new', array(
                    'id' => $user->getId(),
                    '_locale' => $this->locale
                        )
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }

    public function testNewByUserLogged() {

        $user = $this->findUserLoggued();
        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_address_user_new', array(
                    'id' => $user->getId(),
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testCreateUpdateByUserLogged() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('Create', array(), 'messages', $this->locale);
        $user = $this->findUserLoggued();

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_address_user_new', array(
                    'id' => $user->getId(),
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->filter('form[name="ffa"]')->form();

        $form['ffa[name]'] = $this->user_name;
        $form['ffa[street]'] = $this->user_street;
        $form['ffa[streetComplement]'] = $this->user_street_complement;
        $form['ffa[postcode]'] = $this->user_postcode;
        $form['ffa[city]'] = $this->user_city;
        $form['ffa[country]'] = $this->user_country->getId();

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $address = $this->findUserAddress();
        $this->assertNotNull($address);

        /*         * **** Update ***** */
        $update = $this->translator->trans('Update', array(), 'messages', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_address_edit', array(
                    '_locale' => $this->locale,
                    'id' => $address->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->filter('form[name="ffa"]')->form();

        $form['ffa[name]'] = $this->updated_name;
        $form['ffa[street]'] = $this->user_street;
        $form['ffa[streetComplement]'] = $this->user_street_complement;
        $form['ffa[postcode]'] = $this->user_postcode;
        $form['ffa[city]'] = $this->user_city;
        $form['ffa[country]'] = $this->user_country->getId();

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($address);
        $this->assertEquals($this->updated_name, $address->getName());
    }

    public function testDeleteAnonymous() {

        $user = $this->findUserLoggued();
        $addresses = $user->getAddresses();
        $count = count($addresses);
        $this->assertGreaterThan(0, $count);
        $address = $addresses[0];

        $crawler = $this->client->request('POST', $this->router->generate('front_address_delete', array(
                    'id' => $address->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }

    public function testDeleteLogged() {

        $user = $this->findUserLoggued();
        $addresses = $user->getAddresses();
        $count = count($addresses);
        $this->assertGreaterThan(0, $count);
        $address = $addresses[0];

        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_address_delete', array(
                    'id' => $address->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->em->refresh($user);
        $this->assertLessThan($count, count($user->getAddresses()));
    }

    public function testShow() {
        $adresses = $this->findAllAddresses();
        foreach ($adresses as $adress) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_address_show', array(
                        'id' => $adress->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testShowWithButtons() {
        $adresses = $this->findAllAddresses();
        foreach ($adresses as $adress) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_address_show_with_buttons', array(
                        'id' => $adress->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

}
