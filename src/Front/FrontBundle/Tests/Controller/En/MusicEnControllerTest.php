<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Translation\Translator;

class MusicEnControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'en';
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

    private function findAllMusics() {
        return $this->em->getRepository('FrontFrontBundle:Music')->findAll();
    }

    private function findOneMusic() {
        foreach ($this->findAllMusics() as $music)
            return $music;
    }

    private function findOneTag() {
        return $this->em->getRepository('FrontFrontBundle:Tag')->findOneByName('salsa');
    }

    private function findOneUserWithMusic() {
        $users = $this->em->getRepository('UserUserBundle:User')->findWithMusic(1);
        foreach ($users as $user)
            return $user;
    }

    private function deleteData() {

        $music = $this->em->getRepository('FrontFrontBundle:Music')->findOneBy(
                array('url' => "https://open.spotify.com/track/testcreate" . $this->locale)
        );
        if ($music)
            $this->em->remove($music);

        $music = $this->em->getRepository('FrontFrontBundle:Music')->findOneBy(
                array('url' => "https://open.spotify.com/track/testupdate" . $this->locale)
        );
        if ($music)
            $this->em->remove($music);

        $this->em->flush();

        $music = $this->findOneMusic();
        foreach ($music->getLovesMe() as $love) {
            $love->removeMusiclove($music);
            $this->em->persist($love);
        }
        $this->em->flush();
    }

    public function testNew() {
        $user = $this->findUser();
        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_music_new', array(
                    'id' => $user->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testCreateUpdateDelete() {

        $create = $this->translator->trans('Create', array(), 'messages', $this->locale);
        $update = $this->translator->trans('Update', array(), 'messages', $this->locale);

        $user = $this->findUser();
        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_music_new', array(
                    'id' => $user->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        /*         * **** Create ***** */
        $url = "https://open.spotify.com/track/testcreate" . $this->locale;
        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();
        $form['front_frontbundle_music[url]'] = $url;
        $crawler = $this->clientLogged->submit($form);
        $this->clientLogged->followRedirect();
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $musics = $this->em->getRepository('FrontFrontBundle:Music')->findBy(
                array(
                    'url' => $url,
                )
        );
        $this->assertEquals(1, count($musics));

        /*         * **** Update ***** */
        $music = $this->em->getRepository('FrontFrontBundle:Music')->findOneBy(
                array(
                    'url' => $url,
                )
        );
        $url = "https://open.spotify.com/track/testupdate" . $this->locale;
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_music_update', array(
                    'id' => $music->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();
        $form['front_frontbundle_music[url]'] = $url;
        $crawler = $this->clientLogged->submit($form);
        $this->clientLogged->followRedirect();
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $musics = $this->em->getRepository('FrontFrontBundle:Music')->findBy(
                array(
                    'url' => $url,
                )
        );
        $this->assertEquals(1, count($musics));


        /*         * **** Delete ***** */
        $music = $this->em->getRepository('FrontFrontBundle:Music')->findOneBy(
                array(
                    'url' => $url,
                )
        );
        $crawler = $this->client->request('POST', $this->router->generate('front_music_delete', array(
                    'id' => $music->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());

        $musics = $this->em->getRepository('FrontFrontBundle:Music')->findBy(
                array(
                    'url' => $url,
                )
        );
        $this->assertEquals(1, count($musics));

        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_music_delete', array(
                    'id' => $music->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $musics = $this->em->getRepository('FrontFrontBundle:Music')->findBy(
                array(
                    'url' => $url,
                )
        );
        $this->assertEquals(0, count($musics));
    }

    public function testShow() {
        $musics = $this->findAllMusics();
        foreach ($musics as $music) {
            $crawler = $this->client->request('GET', $this->router->generate('front_music_show', array(
                        'id' => $music->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->client->getResponse()->isSuccessful());

            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_music_show', array(
                        'id' => $music->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testShowWithButtons() {
        $musics = $this->findAllMusics();
        foreach ($musics as $music) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_music_show_with_buttons', array(
                        'id' => $music->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testEditAnonymous() {
        $music = $this->findOneMusic();
        $crawler = $this->client->request('GET', $this->router->generate('front_music_edit', array(
                    'id' => $music->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }

    public function testEditLoggued() {
        $musics = $this->findAllMusics();
        foreach ($musics as $music) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_music_edit', array(
                        'id' => $music->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testIndex() {
        $crawler = $this->client->request('GET', $this->router->generate('front_music', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_music', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testFilterAnonymous() {

        $crawler = $this->client->request('POST', $this->router->generate('front_music', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $form = $crawler->filter('#music_filter_form button[type=submit]')->form();
        $form['music_filter[search]'] = 'salsa';
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());


        $Tag = $this->findOneTag();
        $crawler = $this->client->request('POST', $this->router->generate('front_music', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $form = $crawler->filter('#music_filter_form button[type=submit]')->form();
        $form['music_filter[tag]'] = $Tag->getTitle();
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $user = $this->findOneUserWithMusic();
        $crawler = $this->client->request('POST', $this->router->generate('front_music', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $form = $crawler->filter('#music_filter_form button[type=submit]')->form();
        $form['music_filter[user]'] = $user->getUsername();
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testFilterLoggued() {

        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_music', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $form = $crawler->filter('#music_filter_form button[type=submit]')->form();
        $form['music_filter[search]'] = 'salsa';
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $Tag = $this->findOneTag();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_music', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $form = $crawler->filter('#music_filter_form button[type=submit]')->form();
        $form['music_filter[tag]'] = $Tag->getTitle();
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $user = $this->findOneUserWithMusic();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_music', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $form = $crawler->filter('#music_filter_form button[type=submit]')->form();
        $form['music_filter[user]'] = $user->getUsername();
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testLove() {
        $music = $this->findOneMusic();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_music_love', array(
                    'id' => $music->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->em->refresh($music);
        $this->assertEquals(1, count($music->getLovesMe()));
    }

    public function testUnlove() {
        $music = $this->findOneMusic();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_music_unlove', array(
                    'id' => $music->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->em->refresh($music);
        $this->assertEquals(0, count($music->getLovesMe()));
    }

}
