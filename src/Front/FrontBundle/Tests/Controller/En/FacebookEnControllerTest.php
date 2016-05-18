<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Translation\Translator;

class FacebookFrControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'en';
    private $client;
    private $clientLogged;
    private $clientFacebook;
    private $username = 'Jerome';
    private $email = 'serviceclient@directdev.fr';
    private $PHP_AUTH_USER = 'Jerome';
    private $PHP_AUTH_PW = '1234';
    private $PHP_AUTH_USER_FACEBOOK = 'facebook-user';
    private $PHP_AUTH_PW_FACEBOOK = '1234';

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
        
        $this->clientFacebook = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER_FACEBOOK,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW_FACEBOOK
        ));
    }

    public function testImportEventPage() {
        $crawler = $this->client->request('GET', $this->router->generate('facebook_import_event_page', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('facebook_import_event_page', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        
        $crawler = $this->clientFacebook->request('GET', $this->router->generate('facebook_import_event_page', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientFacebook->getResponse()->isSuccessful());
    }


}
