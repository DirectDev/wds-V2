<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MusicTypeControllerTest extends WebTestCase {

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

        $this->name = '_admin_musictype_name_' . $this->locale;
        $this->updated_name = $this->name . '_updated';
        $this->title = 'title';

        $this->deleteData();
    }

    private function deleteData() {
        if ($musictype = $this->findMusicType())
            $this->em->remove($musictype);

        $this->em->flush();
    }

    private function findAllMusicTypes() {
        return $this->em->getRepository('FrontFrontBundle:MusicType')->findBy(array(), null, 1);
    }

    private function findOneMusicType() {
        foreach ($this->findAllMusicTypes() as $musictype)
            return $musictype;
    }

    private function findMusicType() {
        $musictype = $this->em->getRepository('FrontFrontBundle:MusicType')->findOneBy(
                array(
                    'name' => $this->name,
                )
        );
        if ($musictype)
            return $musictype;
        $musictype = $this->em->getRepository('FrontFrontBundle:MusicType')->findOneBy(
                array(
                    'name' => $this->updated_name,
                )
        );
        if ($musictype)
            return $musictype;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_musictype', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_musictype_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_musictype[name]'] = $this->name;
        $form['aab_musictype[translations][' . $this->locale . '][title]'] = $this->title;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        var_dump($response->getContent());

        $musictype = $this->findMusicType();
        $this->assertNotNull($musictype);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_musictype_edit', array(
                    '_locale' => $this->locale,
                    'id' => $musictype->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_musictype[name]'] = $this->updated_name;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($musictype);
        $this->assertEquals($this->updated_name, $musictype->getName());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_musics_before = $this->em->getRepository('FrontFrontBundle:Music')->count();
        $count_musictypes_before = $this->em->getRepository('FrontFrontBundle:MusicType')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $musictype = $this->findOneMusicType();
        $this->assertNotNull($musictype);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_musictype_edit', array(
                    '_locale' => $this->locale,
                    'id' => $musictype->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('FrontFrontBundle:MusicType')->findOneById($musictype->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_musics_after = $this->em->getRepository('FrontFrontBundle:Music')->count();
        $count_musictypes_after = $this->em->getRepository('FrontFrontBundle:MusicType')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals($count_events_before, $count_events_after);
        $this->assertEquals($count_musics_before, $count_musics_after);
        $this->assertEquals(($count_musictypes_before - 1), $count_musictypes_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
