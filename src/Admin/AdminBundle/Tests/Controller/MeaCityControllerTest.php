<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MeaCityControllerTest extends WebTestCase {

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
    private $image = null;
    private $updated_image = null;
    private $description = null;
    private $edito = null;

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

        $this->image = '_admin_mea_city_image_' . $this->locale;
        $this->updated_image = $this->image . '_updated';
        $this->description = 'description';
        $this->edito = 'edito';

        $this->deleteData();
    }

    private function deleteData() {
        if ($mea_city = $this->findMeaCity())
            $this->em->remove($mea_city);

        $this->em->flush();
    }

    private function findAllMeaCitys() {
        return $this->em->getRepository('FrontFrontBundle:MeaCity')->findBy(array(), null, 5);
    }

    private function findOneMeaCity() {
        foreach ($this->findAllMeaCitys() as $mea_city)
            return $mea_city;
    }

    private function findMeaCity() {
        $mea_city = $this->em->getRepository('FrontFrontBundle:MeaCity')->findOneBy(
                array(
                    'image' => $this->image,
                )
        );
        if ($mea_city)
            return $mea_city;
        $mea_city = $this->em->getRepository('FrontFrontBundle:MeaCity')->findOneBy(
                array(
                    'image' => $this->updated_image,
                )
        );
        if ($mea_city)
            return $mea_city;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_mea_city', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }
    
    public function testShow() {
        $meaCitys = $this->findAllMeaCitys();
        foreach ($meaCitys as $meaCity) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_mea_city_show', array(
                        'id' => $meaCity->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_mea_city_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_meacity[image]'] = $this->image;
        $form['aab_meacity[ordre]'] = 12;
        $form['aab_meacity[translations][' . $this->locale . '][description]'] = $this->description;
        $form['aab_meacity[translations][' . $this->locale . '][edito]'] = $this->edito;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        var_dump($response->getContent());

        $mea_city = $this->findMeaCity();
        $this->assertNotNull($mea_city);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_mea_city_edit', array(
                    '_locale' => $this->locale,
                    'id' => $mea_city->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_meacity[image]'] = $this->updated_image;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($mea_city);
        $this->assertEquals($this->updated_image, $mea_city->getImage());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_mea_cities_before = $this->em->getRepository('FrontFrontBundle:MeaCity')->count();
        $count_cities_before = $this->em->getRepository('FrontFrontBundle:City')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $mea_city = $this->findOneMeaCity();
        $this->assertNotNull($mea_city);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_mea_city_edit', array(
                    '_locale' => $this->locale,
                    'id' => $mea_city->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('FrontFrontBundle:MeaCity')->findOneById($mea_city->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_mea_cities_after = $this->em->getRepository('FrontFrontBundle:MeaCity')->count();
        $count_cities_after = $this->em->getRepository('FrontFrontBundle:City')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals($count_events_before, $count_events_after);
        $this->assertEquals(($count_mea_cities_before - 1), $count_mea_cities_after);
        $this->assertEquals($count_cities_before, $count_cities_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
