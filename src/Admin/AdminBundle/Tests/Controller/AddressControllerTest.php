<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddressControllerTest extends WebTestCase {

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
    private $street = null;
    private $street_complement = null;
    private $postcode = null;
    private $city = null;
    private $country = null;

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

        $this->name = 'address_name_' . $this->locale;
        $this->updated_name = $this->name . '_updated';
        $this->street = 'street_' . $this->locale;
        $this->street_complement = 'street_complement_' . $this->locale;
        $this->city = 'admin_city';
        $this->postcode = '59000';
        $this->country = $this->findCountry();
        
        $this->deleteData();
    }
    
    private function deleteData() {
        if ($address = $this->findAddress())
            $this->em->remove($address);

        $this->em->flush();
    }

    private function findCountry() {
        return $this->em->getRepository('FrontFrontBundle:Country')->findOneByIso2('fr');
    }

    private function findAllAddresses() {
        return $this->em->getRepository('FrontFrontBundle:Address')->findBy(array(), null, 1);
    }

    private function findOneAddress() {
        foreach ($this->findAllAddresses() as $address)
            return $address;
    }

    private function findAddress() {
        $address = $this->em->getRepository('FrontFrontBundle:Address')->findOneBy(
                array(
                    'city' => $this->city,
                    'street' => $this->street,
                    'country' => $this->country,
                )
        );
        return $address;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_address', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_address_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_address[name]'] = $this->name;
        $form['aab_address[street]'] = $this->street;
        $form['aab_address[streetComplement]'] = $this->street_complement;
        $form['aab_address[postcode]'] = $this->postcode;
        $form['aab_address[city]'] = $this->city;
        $form['aab_address[country]'] = $this->country->getId();

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $address = $this->findAddress();
        $this->assertNotNull($address);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_address_edit', array(
                    '_locale' => $this->locale,
                    'id' => $address->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_address[name]'] = $this->updated_name;
        $form['aab_address[street]'] = $this->street;
        $form['aab_address[streetComplement]'] = $this->street_complement;
        $form['aab_address[postcode]'] = $this->postcode;
        $form['aab_address[city]'] = $this->city;
        $form['aab_address[country]'] = $this->country->getId();

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($address);
        $this->assertEquals($this->updated_name, $address->getName());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_addresses_before = $this->em->getRepository('FrontFrontBundle:Address')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $address = $this->findOneAddress();
        $this->assertNotNull($address);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_address_edit', array(
                    '_locale' => $this->locale,
                    'id' => $address->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('FrontFrontBundle:Address')->findOneById($address->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_addresses_after = $this->em->getRepository('FrontFrontBundle:Address')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals($count_events_before, $count_events_after);
        $this->assertEquals(($count_addresses_before - 1), $count_addresses_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
