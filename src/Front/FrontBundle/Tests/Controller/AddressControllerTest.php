<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddressControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $client;
    private $clientLogged;
    private $id_event = 8;
    private $id_user= 1;
    private $event = null;
    private $user = null;
    private $PHP_AUTH_USER = 'Jerome';
    private $PHP_AUTH_PW = '1234';

    public function __construct() {
        $this->client = static::createClient();
        $this->client->followRedirects();

        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));
        $this->clientLogged->followRedirects();

        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->findEvent();
        $this->findUser();
        $this->deleteData();
    }

    private function findEvent() {
        $this->event = $this->em->getRepository('FrontFrontBundle:Event')->find($this->id_event);
    }
    private function findUser() {
        $this->user = $this->em->getRepository('UserUserBundle:User')->find($this->id_user);
    }

    private function deleteData() {

        foreach ($this->event->getAddresses() as $address)
            $this->em->remove($address);
        
        foreach ($this->user->getAddresses() as $address)
            $this->em->remove($address);

        $this->em->flush();
    }

    public function testNewByEventWithClient() {

        $crawler = $this->clientLogged->request('GET', '/address/event/' . $this->event->getId() . '/new');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains('Create', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Create')->form();

        $form['front_frontbundle_address[name]'] = "mon adresse test event";
        $form['front_frontbundle_address[street]'] = "";
        $form['front_frontbundle_address[streetComplement]'] = "";
        $form['front_frontbundle_address[postcode]'] = "";
        $form['front_frontbundle_address[city]'] = "Lille";
        $form['front_frontbundle_address[country]']->select('74');

        $crawler = $this->client->submit($form);

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $addresses = $this->em->getRepository('FrontFrontBundle:Address')->findBy(
                array(
                    'name' => 'mon adresse test event',
                )
        );

        $this->assertEquals(0, count($addresses));
    }

    public function testNewByEventWithClientLogged() {

        $crawler = $this->clientLogged->request('GET', '/address/event/' . $this->event->getId() . '/new');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains('Create', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Create')->form();

        $form['front_frontbundle_address[name]'] = "mon adresse test event";
        $form['front_frontbundle_address[street]'] = "";
        $form['front_frontbundle_address[streetComplement]'] = "";
        $form['front_frontbundle_address[postcode]'] = "";
        $form['front_frontbundle_address[city]'] = "Lille";
        $form['front_frontbundle_address[country]']->select('74');

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $addresses = $this->em->getRepository('FrontFrontBundle:Address')->findBy(
                array(
                    'name' => 'mon adresse test event',
                )
        );

        $this->assertEquals(1, count($addresses));
    }
    
    public function testNewByUserWithClientLogged() {

        $crawler = $this->clientLogged->request('GET', '/address/user/' . $this->user->getId() . '/new');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains('Create', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Create')->form();

        $form['front_frontbundle_address[name]'] = "mon adresse test user";
        $form['front_frontbundle_address[street]'] = "";
        $form['front_frontbundle_address[streetComplement]'] = "";
        $form['front_frontbundle_address[postcode]'] = "";
        $form['front_frontbundle_address[city]'] = "Lille";
        $form['front_frontbundle_address[country]']->select('74');

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $addresses = $this->em->getRepository('FrontFrontBundle:Address')->findBy(
                array(
                    'name' => 'mon adresse test user',
                )
        );

        $this->assertEquals(1, count($addresses));
    }

    public function testUpdateWithClient() {

        $this->em->refresh($this->event);
        $address = $this->event->getAddress();
        $this->assertNotNull($address);

        $crawler = $this->clientLogged->request('GET', '/address/' . $address->getId() . '/edit');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains('Update', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Update')->form();

        $form['front_frontbundle_address[name]'] = "mon adresse test event";
        $form['front_frontbundle_address[street]'] = "ma rue";
        $form['front_frontbundle_address[streetComplement]'] = "numéro appart";
        $form['front_frontbundle_address[postcode]'] = "75000";
        $form['front_frontbundle_address[city]'] = "Paris";
        $form['front_frontbundle_address[country]']->select('74');

        $crawler = $this->client->submit($form);

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $addresses = $this->em->getRepository('FrontFrontBundle:Address')->findBy(
                array(
                    'name' => 'mon adresse test event',
                    'postcode' => '75000'
                )
        );

        $this->assertEquals(0, count($addresses));
    }

    public function testUpdateWithClientLogged() {

        $this->em->refresh($this->event);
        $address = $this->event->getAddress();
        $this->assertNotNull($address);

        $crawler = $this->clientLogged->request('GET', '/address/' . $address->getId() . '/edit');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains('Update', $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton('Update')->form();

        $form['front_frontbundle_address[name]'] = "mon adresse test event";
        $form['front_frontbundle_address[street]'] = "ma rue";
        $form['front_frontbundle_address[streetComplement]'] = "numéro appart";
        $form['front_frontbundle_address[postcode]'] = "59000";
        $form['front_frontbundle_address[city]'] = "Lille";
        $form['front_frontbundle_address[country]']->select('74');

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $addresses = $this->em->getRepository('FrontFrontBundle:Address')->findBy(
                array(
                    'name' => 'mon adresse test event',
                    'postcode' => '59000'
                )
        );

        $this->assertEquals(1, count($addresses));
    }

    public function testDeleteWithClient() {

        $this->em->refresh($this->event);
        $address = $this->event->getAddress();
        $this->assertNotNull($address);

        $crawler = $this->clientLogged->request('GET', '/event/' . $this->event->getURI() . '/' . $this->event->getId());
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $form = $crawler->filter('form[action="/address/' . $address->getId() . '/delete"]')->form();
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $this->em->refresh($this->event);
        $this->assertEquals(1, count($this->event->getAddresses()));
    }

    public function testDeleteWithClientLogged() {

        $this->em->refresh($this->event);
        $address = $this->event->getAddress();
        $this->assertNotNull($address);

        $crawler = $this->clientLogged->request('GET', '/event/' . $this->event->getURI() . '/' . $this->event->getId());
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $form = $crawler->filter('form[action="/address/' . $address->getId() . '/delete"]')->form();
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->em->refresh($this->event);
        $this->assertEquals(0, count($this->event->getAddresses()));
    }

}
