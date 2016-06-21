<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CityControllerTest extends WebTestCase {

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
    private $latitude = null;
    private $longitude = null;

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

        $this->name = '_admin_city_name_' . $this->locale;
        $this->updated_name = $this->name . '_updated';
        $this->latitude = -29.90278;
        $this->longitude = -33.2075;

        $this->deleteData();
    }

    private function deleteData() {
        if ($city = $this->findCity())
            $this->em->remove($city);

        $this->em->flush();
    }

    private function findAllCities() {
        return $this->em->getRepository('FrontFrontBundle:City')->findBy(array(), null, 1);
    }

    private function findOneCity() {
        foreach ($this->findAllCities() as $city)
            return $city;
    }

    private function findCity() {
        $city = $this->em->getRepository('FrontFrontBundle:City')->findOneBy(
                array(
                    'name' => $this->name,
                )
        );
        if ($city)
            return $city;
        $city = $this->em->getRepository('FrontFrontBundle:City')->findOneBy(
                array(
                    'name' => $this->updated_name,
                )
        );
        if ($city)
            return $city;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_city', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_city_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_city[name]'] = $this->name;
        $form['aab_city[latitude]'] = $this->latitude;
        $form['aab_city[longitude]'] = $this->longitude;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        var_dump($response->getContent());

        $city = $this->findCity();
        $this->assertNotNull($city);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_city_edit', array(
                    '_locale' => $this->locale,
                    'id' => $city->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_city[name]'] = $this->updated_name;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($city);
        $this->assertEquals($this->updated_name, $city->getName());
    }

    public function testDelete() {
        $city = $this->findOneCity();
        $this->assertNotNull($city);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_city_delete', array(
                    '_locale' => $this->locale,
                    'id' => $city->getId(),
                        )
        ));
        $this->assertFalse($this->clientLogged->getResponse()->isSuccessful());
    }

}
