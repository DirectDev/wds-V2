<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Translation\Translator;

class VideoFrControllerTest extends WebTestCase {

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

        $this->deleteData();
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

    private function findOneVideo() {
        foreach ($this->findAllVideos() as $video)
            return $video;
    }

    private function findOneTag() {
        return $this->em->getRepository('FrontFrontBundle:Tag')->findOneByName('salsa');
    }

    private function findOneUserWithVideo() {
        $users = $this->em->getRepository('UserUserBundle:User')->findWithVideo(1);
        foreach ($users as $user)
            return $user;
    }

    private function deleteData() {

        $video = $this->em->getRepository('FrontFrontBundle:Video')->findOneBy(
                array('url' => "https://vimeo.com/2374758" . $this->locale)
        );
        if ($video)
            $this->em->remove($video);

        $video = $this->em->getRepository('FrontFrontBundle:Video')->findOneBy(
                array('url' => "https://vimeo.com/2374758" . $this->locale)
        );
        if ($video)
            $this->em->remove($video);

        $this->em->flush();

        $video = $this->findOneVideo();
        foreach ($video->getLovesMe() as $love) {
            $love->removeVideolove($video);
            $this->em->persist($love);
        }
        $this->em->flush();
    }

    public function testNew() {
        $user = $this->findUser();
        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_video_new', array(
                    'id' => $user->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testCreateUpdateDelete() {

        $create = $this->translator->trans('Create', array(), 'messages', $this->locale);
        $update = $this->translator->trans('Update', array(), 'messages', $this->locale);

        $user = $this->findUser();
        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_video_new', array(
                    'id' => $user->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        /*         * **** Create ***** */
        $url = "https://open.spotify.com/track/testcreate" . $this->locale;
        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();
        $form['ffv[url]'] = $url;
        $crawler = $this->clientLogged->submit($form);
        $this->clientLogged->followRedirect();
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $videos = $this->em->getRepository('FrontFrontBundle:Video')->findBy(
                array(
                    'url' => $url,
                )
        );
        $this->assertEquals(1, count($videos));

        /*         * **** Update ***** */
        $video = $this->em->getRepository('FrontFrontBundle:Video')->findOneBy(
                array(
                    'url' => $url,
                )
        );
        $url = "https://open.spotify.com/track/testupdate" . $this->locale;
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_video_update', array(
                    'id' => $video->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();
        $form['ffv[url]'] = $url;
        $crawler = $this->clientLogged->submit($form);
        $this->clientLogged->followRedirect();
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $videos = $this->em->getRepository('FrontFrontBundle:Video')->findBy(
                array(
                    'url' => $url,
                )
        );
        $this->assertEquals(1, count($videos));


        /*         * **** Delete ***** */
        $video = $this->em->getRepository('FrontFrontBundle:Video')->findOneBy(
                array(
                    'url' => $url,
                )
        );
        $crawler = $this->client->request('POST', $this->router->generate('front_video_delete', array(
                    'id' => $video->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());

        $videos = $this->em->getRepository('FrontFrontBundle:Video')->findBy(
                array(
                    'url' => $url,
                )
        );
        $this->assertEquals(1, count($videos));

        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_video_delete', array(
                    'id' => $video->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $videos = $this->em->getRepository('FrontFrontBundle:Video')->findBy(
                array(
                    'url' => $url,
                )
        );
        $this->assertEquals(0, count($videos));
    }

    public function testShow() {
        $videos = $this->findAllVideos();
        foreach ($videos as $video) {
            $crawler = $this->client->request('GET', $this->router->generate('front_video_show', array(
                        'id' => $video->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->client->getResponse()->isSuccessful());

            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_video_show', array(
                        'id' => $video->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testShowWithButtons() {
        $videos = $this->findAllVideos();
        foreach ($videos as $video) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_video_show_with_buttons', array(
                        'id' => $video->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testEditAnonymous() {
        $video = $this->findOneVideo();
        $crawler = $this->client->request('GET', $this->router->generate('front_video_edit', array(
                    'id' => $video->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }

    public function testEditLoggued() {
        $videos = $this->findAllVideos();
        foreach ($videos as $video) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_video_edit', array(
                        'id' => $video->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testIndex() {
        $crawler = $this->client->request('GET', $this->router->generate('front_video', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_video', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testMoves() {
        $crawler = $this->client->request('GET', $this->router->generate('front_move', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_move', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testFilterAnonymous() {

        $crawler = $this->client->request('POST', $this->router->generate('front_video', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $form = $crawler->filter('#video_filter_form button[type=submit]')->form();
        $form['video_filter[search]'] = 'salsa';
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());


        $Tag = $this->findOneTag();
        $crawler = $this->client->request('POST', $this->router->generate('front_video', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $form = $crawler->filter('#video_filter_form button[type=submit]')->form();
        $form['video_filter[tag]'] = $Tag->getTitle();
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $user = $this->findOneUserWithVideo();
        $crawler = $this->client->request('POST', $this->router->generate('front_video', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $form = $crawler->filter('#video_filter_form button[type=submit]')->form();
        $form['video_filter[user]'] = $user->getUsername();
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testFilterLoggued() {

        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_video', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $form = $crawler->filter('#video_filter_form button[type=submit]')->form();
        $form['video_filter[search]'] = 'salsa';
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $Tag = $this->findOneTag();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_video', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $form = $crawler->filter('#video_filter_form button[type=submit]')->form();
        $form['video_filter[tag]'] = $Tag->getTitle();
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $user = $this->findOneUserWithVideo();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_video', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $form = $crawler->filter('#video_filter_form button[type=submit]')->form();
        $form['video_filter[user]'] = $user->getUsername();
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testFilterMoveAnonymous() {

        $crawler = $this->client->request('POST', $this->router->generate('front_move', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $form = $crawler->filter('#video_filter_form button[type=submit]')->form();
        $form['video_filter[search]'] = 'salsa';
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());


        $Tag = $this->findOneTag();
        $crawler = $this->client->request('POST', $this->router->generate('front_move', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $form = $crawler->filter('#video_filter_form button[type=submit]')->form();
        $form['video_filter[tag]'] = $Tag->getTitle();
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $user = $this->findOneUserWithVideo();
        $crawler = $this->client->request('POST', $this->router->generate('front_move', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $form = $crawler->filter('#video_filter_form button[type=submit]')->form();
        $form['video_filter[user]'] = $user->getUsername();
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testFilterMoveLoggued() {

        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_move', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $form = $crawler->filter('#video_filter_form button[type=submit]')->form();
        $form['video_filter[search]'] = 'salsa';
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $Tag = $this->findOneTag();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_move', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $form = $crawler->filter('#video_filter_form button[type=submit]')->form();
        $form['video_filter[tag]'] = $Tag->getTitle();
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $user = $this->findOneUserWithVideo();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_move', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $form = $crawler->filter('#video_filter_form button[type=submit]')->form();
        $form['video_filter[user]'] = $user->getUsername();
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testLove() {
        $video = $this->findOneVideo();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_video_love', array(
                    'id' => $video->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->em->refresh($video);
        $this->assertEquals(1, count($video->getLovesMe()));
    }

    public function testUnlove() {
        $video = $this->findOneVideo();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_video_unlove', array(
                    'id' => $video->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->em->refresh($video);
        $this->assertEquals(0, count($video->getLovesMe()));
    }

}
