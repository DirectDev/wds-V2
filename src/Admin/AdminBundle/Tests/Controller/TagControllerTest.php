<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TagControllerTest extends WebTestCase {

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

        $this->name = '_admin_tag_name_' . $this->locale;
        $this->updated_name = $this->name . '_updated';
        $this->title = 'title';

        $this->deleteData();
    }

    private function deleteData() {
        if ($tag = $this->findTag())
            $this->em->remove($tag);

        $this->em->flush();
    }

    private function findAllTags() {
        return $this->em->getRepository('FrontFrontBundle:Tag')->findBy(array(), null, 5);
    }

    private function findOneTag() {
        foreach ($this->findAllTags() as $tag)
            return $tag;
    }

    private function findTag() {
        $tag = $this->em->getRepository('FrontFrontBundle:Tag')->findOneBy(
                array(
                    'name' => $this->name,
                )
        );
        if ($tag)
            return $tag;
        $tag = $this->em->getRepository('FrontFrontBundle:Tag')->findOneBy(
                array(
                    'name' => $this->updated_name,
                )
        );
        if ($tag)
            return $tag;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_tag', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }
    
    public function testShow() {
        $tags = $this->findAllTags();
        foreach ($tags as $tag) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_tag_show', array(
                        'id' => $tag->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_tag_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_tag[name]'] = $this->name;
        $form['aab_tag[translations][' . $this->locale . '][title]'] = $this->title;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        

        $tag = $this->findTag();
        $this->assertNotNull($tag);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_tag_edit', array(
                    '_locale' => $this->locale,
                    'id' => $tag->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_tag[name]'] = $this->updated_name;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($tag);
        $this->assertEquals($this->updated_name, $tag->getName());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_tags_before = $this->em->getRepository('FrontFrontBundle:Tag')->count();
        $count_musics_before = $this->em->getRepository('FrontFrontBundle:Music')->count();
        $count_videos_before = $this->em->getRepository('FrontFrontBundle:Video')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $tag = $this->findOneTag();
        $this->assertNotNull($tag);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_tag_edit', array(
                    '_locale' => $this->locale,
                    'id' => $tag->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('FrontFrontBundle:Tag')->findOneById($tag->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_tags_after = $this->em->getRepository('FrontFrontBundle:Tag')->count();
        $count_musics_after = $this->em->getRepository('FrontFrontBundle:Music')->count();
        $count_videos_after = $this->em->getRepository('FrontFrontBundle:Video')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals($count_events_before, $count_events_after);
        $this->assertEquals($count_musics_before, $count_musics_after);
        $this->assertEquals($count_videos_before, $count_videos_after);
        $this->assertEquals(($count_tags_before - 1), $count_tags_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
