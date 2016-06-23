<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase {

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
    private $description = null;
    private $content = null;

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

        $this->name = '_admin_page_name_' . $this->locale;
        $this->updated_name = $this->name . '_updated';
        $this->title = 'title';
        $this->description = 'description';
        $this->content = 'content';

        $this->deleteData();
    }

    private function deleteData() {
        if ($page = $this->findPage())
            $this->em->remove($page);

        $this->em->flush();
    }

    private function findAllPages() {
        return $this->em->getRepository('AdminAdminBundle:Page')->findBy(array(), null, 5);
    }

    private function findOnePage() {
        foreach ($this->findAllPages() as $page)
            return $page;
    }

    private function findPage() {
        $page = $this->em->getRepository('AdminAdminBundle:Page')->findOneBy(
                array(
                    'name' => $this->name,
                )
        );
        if ($page)
            return $page;
        $page = $this->em->getRepository('AdminAdminBundle:Page')->findOneBy(
                array(
                    'name' => $this->updated_name,
                )
        );
        if ($page)
            return $page;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_page', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }
    
    public function testShow() {
        $pages = $this->findAllPages();
        foreach ($pages as $page) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_page_show', array(
                        'id' => $page->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_page_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_page[name]'] = $this->name;
        $form['aab_page[translations][' . $this->locale . '][title]'] = $this->title;
        $form['aab_page[translations][' . $this->locale . '][description]'] = $this->description;
        $form['aab_page[translations][' . $this->locale . '][content]'] = $this->content;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        

        $page = $this->findPage();
        $this->assertNotNull($page);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_page_edit', array(
                    '_locale' => $this->locale,
                    'id' => $page->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_page[name]'] = $this->updated_name;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($page);
        $this->assertEquals($this->updated_name, $page->getName());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_pages_before = $this->em->getRepository('AdminAdminBundle:Page')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $page = $this->findOnePage();
        $this->assertNotNull($page);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_page_edit', array(
                    '_locale' => $this->locale,
                    'id' => $page->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('AdminAdminBundle:Page')->findOneById($page->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_pages_after = $this->em->getRepository('AdminAdminBundle:Page')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals($count_events_before, $count_events_after);
        $this->assertEquals(($count_pages_before - 1), $count_pages_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
