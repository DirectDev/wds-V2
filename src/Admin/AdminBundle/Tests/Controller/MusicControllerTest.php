<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MusicControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'en';
    private $clientLogged;
    private $PHP_AUTH_USER = 'Jerome';
    private $PHP_AUTH_PW = '1234';
    private $name = null;
    private $updated_name = null;
    private $url = null;
    private $title = null;

    public function __construct() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));

        $this->router = $this->clientLogged->getContainer()->get('router');
        $this->translator = $this->clientLogged->getContainer()->get('translator');

        $this->name = '_admin_music_name_' . $this->locale;
        $this->updated_name = $this->name . '_updated';
        $this->url = 'http://url';
        $this->title = 'title';

        $this->deleteData();
    }

    private function deleteData() {
        if ($music = $this->findMusic())
            $this->em->remove($music);

        $this->em->flush();
    }

    private function findAllMusics() {
        return $this->em->getRepository('FrontFrontBundle:Music')->findBy(array(), null, 1);
    }

    private function findOneMusic() {
        foreach ($this->findAllMusics() as $music)
            return $music;
    }

    private function findMusic() {
        $music = $this->em->getRepository('FrontFrontBundle:Music')->findOneBy(
                array(
                    'name' => $this->name,
                )
        );
        if ($music)
            return $music;
        $music = $this->em->getRepository('FrontFrontBundle:Music')->findOneBy(
                array(
                    'name' => $this->updated_name,
                )
        );
        if ($music)
            return $music;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_music', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_music_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_music[name]'] = $this->name;
        $form['aab_music[url]'] = $this->url;
        $form['aab_music[translations][' . $this->locale . '][title]'] = $this->title;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        var_dump($response->getContent());

        $music = $this->findMusic();
        $this->assertNotNull($music);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_music_edit', array(
                    '_locale' => $this->locale,
                    'id' => $music->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_music[name]'] = $this->updated_name;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($music);
        $this->assertEquals($this->updated_name, $music->getName());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_musics_before = $this->em->getRepository('FrontFrontBundle:Music')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $music = $this->findOneMusic();
        $this->assertNotNull($music);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_music_edit', array(
                    '_locale' => $this->locale,
                    'id' => $music->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('FrontFrontBundle:Music')->findOneById($music->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_musics_after = $this->em->getRepository('FrontFrontBundle:Music')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals($count_events_before, $count_events_after);
        $this->assertEquals(($count_musics_before - 1), $count_musics_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
