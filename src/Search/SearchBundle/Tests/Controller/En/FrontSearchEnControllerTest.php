<?php

namespace Search\SearchBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontSearchEnControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'en';
    private $client;
    private $clientLogged;
    private $PHP_AUTH_USER = 'Jerome';
    private $PHP_AUTH_PW = '1234';
    private $unknown_city = 'liverpool';

    public function __construct() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->client = static::createClient();
        $this->client->followRedirects();

        $this->router = $this->client->getContainer()->get('router');
        $this->translator = $this->client->getContainer()->get('translator');

        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));
    }

    public function testEventFrontSearchAnonymous() {

        $crawler = $this->client->request('GET', $this->router->generate('search_search_front_event', array('_locale' => $this->locale)));
        $this->assertFalse($this->client->getResponse()->isSuccessful());

        $cities = $this->em->getRepository('FrontFrontBundle:City')->findAll();
        foreach ($cities as $city) {
            $route = $this->router->generate('search_search_front_event', array('_locale' => $this->locale,));
            $route .= "?searchcity=" . urlencode($city->getName()) . "&searcheventdate=" . date('Y-m-d');
            $crawler = $this->client->request('GET', $route);

            $this->assertTrue($this->client->getResponse()->isSuccessful());
            $this->assertContains($this->stripAccents($city->getName()), $this->stripAccents($crawler->filter('title')->text()));
        }

        $crawler = $this->client->request('GET', $this->router->generate('search_search_front_event', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

//    public function testUnknownCityAnonymous() {
//        // bug google api on travis
//
//        $crawler = $this->client->request('GET', $this->router->generate('search_search_front_event', array('_locale' => $this->locale)));
//        $this->assertFalse($this->client->getResponse()->isSuccessful());
//
//        $route = $this->router->generate('search_search_front_event', array('_locale' => $this->locale,));
//        $route .= "?searchcity=" . urlencode($this->unknown_city) . "&searcheventdate=" . date('Y-m-d');
//        $crawler = $this->client->request('GET', $route);
//
//        $this->assertTrue($this->client->getResponse()->isSuccessful());
//        $this->assertContains($this->stripAccents($this->unknown_city), $this->stripAccents($crawler->filter('title')->text()));
//
//        $crawler = $this->client->request('GET', $this->router->generate('search_search_front_event', array('_locale' => $this->locale)));
//        $this->assertTrue($this->client->getResponse()->isSuccessful());
//    }

    public function testEventFrontSearchLogged() {

        $this->clientLogged->followRedirects();

        $crawler = $this->clientLogged->request('GET', $this->router->generate('search_search_front_event', array('_locale' => $this->locale)));
        $this->assertFalse($this->clientLogged->getResponse()->isSuccessful());

        $cities = $this->em->getRepository('FrontFrontBundle:City')->findAll();
        foreach ($cities as $city) {
            $route = $this->router->generate('search_search_front_event', array('_locale' => $this->locale,));
            $route .= "?searchcity=" . urlencode($city->getName()) . "&searcheventdate=" . date('Y-m-d');
            $crawler = $this->clientLogged->request('GET', $route);

            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
            $this->assertContains($this->stripAccents($city->getName()), $this->stripAccents($crawler->filter('title')->text()));
        }

        $crawler = $this->clientLogged->request('GET', $this->router->generate('search_search_front_event', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    private function stripAccents($string) {
        return strtolower(strtr($string, 'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'));
    }

}
