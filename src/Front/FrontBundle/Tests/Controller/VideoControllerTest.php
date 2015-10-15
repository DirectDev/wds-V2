<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VideoControllerTest extends WebTestCase {

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

    private function findAllVideos() {
        return $this->em->getRepository('FrontFrontBundle:Video')->findAll();
    }

    public function testNew() {
        $user = $this->findUser();
        $crawler = $this->clientLogged->request('GET', '/video/new/' . $user->getId());
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testShow() {
        $videos = $this->findAllVideos();
        foreach ($videos as $video) {
            $crawler = $this->client->request('GET', '/video/show/' . $video->getId());
            $this->assertTrue($this->client->getResponse()->isSuccessful());

            $crawler = $this->clientLogged->request('GET', '/video/show/' . $video->getId());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testShowWithButtons() {
        $videos = $this->findAllVideos();
        foreach ($videos as $video) {
            $crawler = $this->clientLogged->request('GET', '/video/show_with_buttons/' . $video->getId());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testEdit() {
        $videos = $this->findAllVideos();
        foreach ($videos as $video) {
            $crawler = $this->client->request('GET', '/video/edit/' . $video->getId());
            $this->assertTrue($this->client->getResponse()->isSuccessful());

            $crawler = $this->clientLogged->request('GET', '/video/edit/' . $video->getId());
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

}
