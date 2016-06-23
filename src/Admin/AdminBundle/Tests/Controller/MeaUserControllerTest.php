<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MeaUserControllerTest extends WebTestCase {

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
    private $ordre = null;
    private $updated_ordre = null;
    private $description = null;

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

        $this->ordre = 1000;
        $this->updated_ordre = 1001;
        $this->description = 'description';

        $this->deleteData();
    }

    private function deleteData() {
        if ($mea_user = $this->findMeaUser())
            $this->em->remove($mea_user);

        $this->em->flush();
    }

    private function findAllMeaUsers() {
        return $this->em->getRepository('FrontFrontBundle:MeaUser')->findBy(array(), null, 5);
    }

    private function findOneMeaUser() {
        foreach ($this->findAllMeaUsers() as $mea_user)
            return $mea_user;
    }

    private function findMeaUser() {
        $mea_user = $this->em->getRepository('FrontFrontBundle:MeaUser')->findOneBy(
                array(
                    'ordre' => $this->ordre,
                )
        );
        if ($mea_user)
            return $mea_user;
        $mea_user = $this->em->getRepository('FrontFrontBundle:MeaUser')->findOneBy(
                array(
                    'ordre' => $this->updated_ordre,
                )
        );
        if ($mea_user)
            return $mea_user;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_mea_user', array('_locale' => $this->locale)));
        var_dump($this->clientLogged->getResponse()->getContent());
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }
    
    public function testShow() {
        $meaUsers = $this->findAllMeaUsers();
        foreach ($meaUsers as $meaUser) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_mea_user_show', array(
                        'id' => $meaUser->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_mea_user_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_meauser[ordre]'] = $this->ordre;
        $form['aab_meauser[translations][' . $this->locale . '][description]'] = $this->description;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        var_dump($response->getContent());

        $mea_user = $this->findMeaUser();
        $this->assertNotNull($mea_user);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_mea_user_edit', array(
                    '_locale' => $this->locale,
                    'id' => $mea_user->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_meauser[ordre]'] = $this->updated_ordre;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($mea_user);
        $this->assertEquals($this->updated_ordre, $mea_user->getOrdre());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_mea_users_before = $this->em->getRepository('FrontFrontBundle:MeaUser')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $mea_user = $this->findOneMeaUser();
        $this->assertNotNull($mea_user);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_mea_user_edit', array(
                    '_locale' => $this->locale,
                    'id' => $mea_user->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('FrontFrontBundle:MeaUser')->findOneById($mea_user->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_mea_users_after = $this->em->getRepository('FrontFrontBundle:MeaUser')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals($count_events_before, $count_events_after);
        $this->assertEquals(($count_mea_users_before - 1), $count_mea_users_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
