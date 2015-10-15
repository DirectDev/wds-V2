<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MusicControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
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
        $this->client->followRedirects();

        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));
    }

    private function findUser() {
        return $this->em->getRepository('UserUserBundle:User')->findOneBy(
                        array(
                            'username' => $this->username,
                            'email' => $this->email,
                        )
        );
    }

    private function findAllMusics() {
        return $this->em->getRepository('FrontFrontBundle:Music')->findAll();
    }

    public function testNew() {
        $user = $this->findUser();
        $crawler = $this->clientLogged->request('GET', '/music/new/' . $user->getId());
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testShow() {
        $musics = $this->findAllMusics();
        foreach ($musics as $music) {
            $crawler = $this->client->request('GET', '/music/show/' . $music->getId());
            $this->assertTrue($this->client->getResponse()->isSuccessful());

            $crawler = $this->clientLogged->request('GET', '/music/show/' . $music->getId());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }
    
    public function testShowWithButtons() {
        $musics = $this->findAllMusics();
        foreach ($musics as $music) {
            $crawler = $this->clientLogged->request('GET', '/music/show_with_buttons/' . $music->getId());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testEdit() {
        $musics = $this->findAllMusics();
        foreach ($musics as $music) {
            $crawler = $this->client->request('GET', '/music/edit/' . $music->getId());
            $this->assertTrue($this->client->getResponse()->isSuccessful());

            $crawler = $this->clientLogged->request('GET', '/music/edit/' . $music->getId());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

}
