<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VideoControllerTest extends WebTestCase {

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

        $this->name = '_admin_video_name_' . $this->locale;
        $this->updated_name = $this->name . '_updated';
        $this->url = 'http://url';
        $this->title = 'title';

        $this->deleteData();
    }

    private function deleteData() {
        if ($video = $this->findVideo())
            $this->em->remove($video);

        $this->em->flush();
    }

    private function findAllVideos() {
        return $this->em->getRepository('FrontFrontBundle:Video')->findBy(array(), null, 1);
    }

    private function findOneVideo() {
        foreach ($this->findAllVideos() as $video)
            return $video;
    }

    private function findVideo() {
        $video = $this->em->getRepository('FrontFrontBundle:Video')->findOneBy(
                array(
                    'name' => $this->name,
                )
        );
        if ($video)
            return $video;
        $video = $this->em->getRepository('FrontFrontBundle:Video')->findOneBy(
                array(
                    'name' => $this->updated_name,
                )
        );
        if ($video)
            return $video;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_video', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_video_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_video[name]'] = $this->name;
        $form['aab_video[url]'] = $this->url;
        $form['aab_video[translations][' . $this->locale . '][title]'] = $this->title;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        var_dump($response->getContent());

        $video = $this->findVideo();
        $this->assertNotNull($video);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_video_edit', array(
                    '_locale' => $this->locale,
                    'id' => $video->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_video[name]'] = $this->updated_name;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($video);
        $this->assertEquals($this->updated_name, $video->getName());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_videos_before = $this->em->getRepository('FrontFrontBundle:Video')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $video = $this->findOneVideo();
        $this->assertNotNull($video);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_video_edit', array(
                    '_locale' => $this->locale,
                    'id' => $video->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('FrontFrontBundle:Video')->findOneById($video->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_videos_after = $this->em->getRepository('FrontFrontBundle:Video')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals($count_events_before, $count_events_after);
        $this->assertEquals(($count_videos_before - 1), $count_videos_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
