<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TagEnControllerTest extends WebTestCase {

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

    public function testListForVideoSearch() {
        $crawler = $this->client->request('GET', $this->router->generate('front_tag_list_for_video_search', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_tag_list_for_video_search', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testListForMusicSearch() {
        $crawler = $this->client->request('GET', $this->router->generate('front_tag_list_for_music_search', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_tag_list_for_music_search', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

}
