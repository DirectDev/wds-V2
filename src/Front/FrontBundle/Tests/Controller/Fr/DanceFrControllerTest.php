<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Translation\Translator;

class DanceFrControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'fr';
    private $client;
    private $clientLogged;
    private $username = 'Jerome';
    private $email = 'serviceclient@directdev.fr';
    private $PHP_AUTH_USER = 'Jerome';
    private $PHP_AUTH_PW = '1234';

    public function __construct() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->client = static::createClient();
//        $this->client->followRedirects();

        $this->router = $this->client->getContainer()->get('router');
        $this->translator = $this->client->getContainer()->get('translator');

        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));
    }

    public function testDanceSalsa() {
        $crawler = $this->client->request('GET', $this->router->generate('dance_salsa', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('dance_salsa', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testDanceSalsaCubana() {
        $crawler = $this->client->request('GET', $this->router->generate('dance_salsa_cubana', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('dance_salsa_cubana', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testDanceSalsaOn1() {
        $crawler = $this->client->request('GET', $this->router->generate('dance_salsa_on1', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('dance_salsa_on1', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testDanceSalsaOn2() {
        $crawler = $this->client->request('GET', $this->router->generate('dance_salsa_on2', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('dance_salsa_on2', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testDanceSalsaDominicana() {
        $crawler = $this->client->request('GET', $this->router->generate('dance_salsa_dominicana', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('dance_salsa_dominicana', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testDanceSalsaRueda() {
        $crawler = $this->client->request('GET', $this->router->generate('dance_salsa_rueda', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('dance_salsa_rueda', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testDanceBachata() {
        $crawler = $this->client->request('GET', $this->router->generate('dance_bachata', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('dance_bachata', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testDanceBachataDominicana() {
        $crawler = $this->client->request('GET', $this->router->generate('dance_bachata_dominicana', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('dance_bachata_dominicana', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testDanceBachataSensual() {
        $crawler = $this->client->request('GET', $this->router->generate('dance_bachata_sensual', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('dance_bachata_sensual', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testDanceBachataModerna() {
        $crawler = $this->client->request('GET', $this->router->generate('dance_bachata_moderna', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('dance_bachata', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testDanceKizomba() {
        $crawler = $this->client->request('GET', $this->router->generate('dance_kizomba', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('dance_kizomba', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testDanceMerengue() {
        $crawler = $this->client->request('GET', $this->router->generate('dance_merengue', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('dance_merengue', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testDanceTango() {
        $crawler = $this->client->request('GET', $this->router->generate('dance_tango', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('dance_tango', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

}
