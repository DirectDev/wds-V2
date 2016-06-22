<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageContentControllerTest extends WebTestCase {

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
    private $position = null;
    private $updated_position = null;
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

        $this->position = 1000;
        $this->updated_position = 1001;
        $this->content = 'content';

        $this->deleteData();
    }

    private function deleteData() {
        if ($pagecontent = $this->findPageContent())
            $this->em->remove($pagecontent);

        $this->em->flush();
    }

    private function findAllPageContents() {
        return $this->em->getRepository('AdminAdminBundle:PageContent')->findBy(array(), null, 1);
    }

    private function findOnePageContent() {
        foreach ($this->findAllPageContents() as $pagecontent)
            return $pagecontent;
    }

    private function findPageContent() {
        $pagecontent = $this->em->getRepository('AdminAdminBundle:PageContent')->findOneBy(
                array(
                    'position' => $this->position,
                )
        );
        if ($pagecontent)
            return $pagecontent;
        $pagecontent = $this->em->getRepository('AdminAdminBundle:PageContent')->findOneBy(
                array(
                    'position' => $this->updated_position,
                )
        );
        if ($pagecontent)
            return $pagecontent;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_pagecontent', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_pagecontent_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_pagecontent[position]'] = $this->position;
        $form['aab_pagecontent[translations][' . $this->locale . '][content]'] = $this->content;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        var_dump($response->getContent());

        $pagecontent = $this->findPageContent();
        $this->assertNotNull($pagecontent);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_pagecontent_edit', array(
                    '_locale' => $this->locale,
                    'id' => $pagecontent->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_pagecontent[position]'] = $this->updated_position;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($pagecontent);
        $this->assertEquals($this->updated_position, $pagecontent->getPosition());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_pages_before = $this->em->getRepository('AdminAdminBundle:Page')->count();
        $count_pagecontents_before = $this->em->getRepository('AdminAdminBundle:PageContent')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $pagecontent = $this->findOnePageContent();
        $this->assertNotNull($pagecontent);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_pagecontent_edit', array(
                    '_locale' => $this->locale,
                    'id' => $pagecontent->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('AdminAdminBundle:PageContent')->findOneById($pagecontent->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_pages_after = $this->em->getRepository('AdminAdminBundle:Page')->count();
        $count_pagecontents_after = $this->em->getRepository('AdminAdminBundle:PageContent')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals($count_events_before, $count_events_after);
        $this->assertEquals($count_pages_before, $count_pages_after);
        $this->assertEquals(($count_pagecontents_before - 1), $count_pagecontents_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
