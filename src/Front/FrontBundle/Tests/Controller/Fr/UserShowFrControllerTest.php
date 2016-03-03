<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Translation\Translator;

class UserShowFrControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManagerh
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'fr';
    private $client;
    private $clientLogged;
    private $username;
    private $email;
    private $password;
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

        $this->username = 'new_' . $this->locale;
        $this->email = 'wds_' . $this->locale . '@yopmail.com';
        $this->password = '1234_' . $this->locale;

    }

    private function findAllUsers() {
        return $this->em->getRepository('UserUserBundle:User')->findBy(array(), null, 20);
    }

    public function testShowPublic() {
        $users = $this->findAllUsers();
        foreach ($users as $user) {
            $crawler = $this->client->request('GET', $this->router->generate('front_user_show_public', array(
                        'username' => $user->getUsername(),
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->client->getResponse()->isSuccessful());

            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_user_show_public', array(
                        'username' => $user->getUsername(),
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testShowOverviews() {
        $users = $this->findAllUsers();
        foreach ($users as $user) {
            $crawler = $this->client->request('GET', $this->router->generate('front_user_show_overviews', array(
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->client->getResponse()->isSuccessful());

            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_user_show_overviews', array(
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testShowOverviewsProfile() {
        $users = $this->findAllUsers();
        foreach ($users as $user) {
            $crawler = $this->client->request('GET', $this->router->generate('front_user_show_overviews_profile', array(
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->client->getResponse()->isSuccessful());

            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_user_show_overviews_profile', array(
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }
    
    public function testShowOverviewsIndex() {
        $users = $this->findAllUsers();
        foreach ($users as $user) {
            $crawler = $this->client->request('GET', $this->router->generate('front_user_show_overviews_index', array(
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->client->getResponse()->isSuccessful());

            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_user_show_overviews_index', array(
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testShowPrivate() {
        $crawler = $this->client->request('GET', $this->router->generate('front_user_show_private', array(
                    '_locale' => $this->locale)
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_user_show_private', array(
                    '_locale' => $this->locale)
        ));
        $this->clientLogged->followRedirect();

        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("' . $this->PHP_AUTH_USER . '")')->count()
        );
    }

}
