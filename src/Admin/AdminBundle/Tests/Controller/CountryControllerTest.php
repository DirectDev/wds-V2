<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CountryControllerTest extends WebTestCase {

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
    private $iso2 = null;

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

        $this->name = '_admin_country_name_' . $this->locale;
        $this->updated_name = $this->name . '_updated';
        $this->title = 'admin_country_name' . $this->locale;
        $this->iso2 = 'xx';

        $this->deleteData();
    }

    private function deleteData() {
        if ($country = $this->findCountry())
            $this->em->remove($country);

        $this->em->flush();
    }

    private function findAllCountrys() {
        return $this->em->getRepository('FrontFrontBundle:Country')->findBy(array(), null, 1);
    }

    private function findOneCountry() {
        foreach ($this->findAllCountrys() as $country)
            return $country;
    }

    private function findCountry() {
        $country = $this->em->getRepository('FrontFrontBundle:Country')->findOneBy(
                array(
                    'name' => $this->name,
                )
        );
        if ($country)
            return $country;
        $country = $this->em->getRepository('FrontFrontBundle:Country')->findOneBy(
                array(
                    'name' => $this->updated_name,
                )
        );
        if ($country)
            return $country;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_country', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_country_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_country[name]'] = $this->name;
        $form['aab_country[iso2]'] = $this->iso2;
        $form['aab_country[translations][' . $this->locale . '][title]'] = $this->title;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        var_dump($response->getContent());

        $country = $this->findCountry();
        $this->assertNotNull($country);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_country_edit', array(
                    '_locale' => $this->locale,
                    'id' => $country->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_country[name]'] = $this->updated_name;
        $form['aab_country[iso2]'] = $this->iso2;
        $form['aab_country[translations][' . $this->locale . '][title]'] = $this->title;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($country);
        $this->assertEquals($this->updated_name, $country->getName());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_countrys_before = $this->em->getRepository('FrontFrontBundle:Country')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $country = $this->findOneCountry();
        $this->assertNotNull($country);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_country_edit', array(
                    '_locale' => $this->locale,
                    'id' => $country->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('FrontFrontBundle:Country')->findOneById($country->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_countrys_after = $this->em->getRepository('FrontFrontBundle:Country')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals($count_events_before, $count_events_after);
        $this->assertEquals(($count_countrys_before - 1), $count_countrys_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
