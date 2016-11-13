<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $client;
    private $clientLogged;
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
        $this->router = $this->clientLogged->getContainer()->get('router');
        $this->translator = $this->clientLogged->getContainer()->get('translator');
    }

    public function testIndexEn() {
        $crawler = $this->client->request('GET', $this->router->generate('admin_admin_homepage', array('_locale' => 'en')));
        $this->assertFalse($this->client->getResponse()->isSuccessful());
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_admin_homepage', array('_locale' => 'en')));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testIndexFr() {
        $crawler = $this->client->request('GET', $this->router->generate('admin_admin_homepage', array('_locale' => 'fr')));
        $this->assertFalse($this->client->getResponse()->isSuccessful());
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_admin_homepage', array('_locale' => 'fr')));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testSitemap() {
        $crawler = $this->client->request('GET', $this->router->generate('admin_admin_sitemap', array('_locale' => 'fr')));
        $this->assertFalse($this->client->getResponse()->isSuccessful());
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_admin_sitemap', array('_locale' => 'fr')));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

}
