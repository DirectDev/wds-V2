<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTypeControllerTest extends WebTestCase {

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

        $this->name = '_admin_user_type_name_' . $this->locale;
        $this->updated_name = $this->name . '_updated';
        $this->title = 'title';

        $this->deleteData();
    }

    private function deleteData() {
        if ($usertype = $this->findUserType())
            $this->em->remove($usertype);

        $this->em->flush();
    }

    private function findAllUserTypes() {
        return $this->em->getRepository('UserUserBundle:UserType')->findBy(array(), null, 5);
    }

    private function findOneUserType() {
        foreach ($this->findAllUserTypes() as $usertype)
            return $usertype;
    }

    private function findUserType() {
        $usertype = $this->em->getRepository('UserUserBundle:UserType')->findOneBy(
                array(
                    'name' => $this->name,
                )
        );
        if ($usertype)
            return $usertype;
        $usertype = $this->em->getRepository('UserUserBundle:UserType')->findOneBy(
                array(
                    'name' => $this->updated_name,
                )
        );
        if ($usertype)
            return $usertype;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_user_type', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }
    
    public function testShow() {
        $userTypes = $this->findAllUserTypes();
        foreach ($userTypes as $userType) {
            $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_user_type_show', array(
                        'id' => $userType->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testCreateUpdate() {
        /*         * **** Create ***** */
        $create = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_user_type_new', array(
                    '_locale' => $this->locale
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());


        $this->assertContains($create, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($create)->form();

        $form['aab_usertype[name]'] = $this->name;
        $form['aab_usertype[translations][' . $this->locale . '][title]'] = $this->title;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        

        $usertype = $this->findUserType();
        $this->assertNotNull($usertype);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_user_type_edit', array(
                    '_locale' => $this->locale,
                    'id' => $usertype->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_usertype[name]'] = $this->updated_name;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($usertype);
        $this->assertEquals($this->updated_name, $usertype->getName());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_usertypes_before = $this->em->getRepository('UserUserBundle:UserType')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $usertype = $this->findOneUserType();
        $this->assertNotNull($usertype);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_user_type_edit', array(
                    '_locale' => $this->locale,
                    'id' => $usertype->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('UserUserBundle:UserType')->findOneById($usertype->getId())));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_usertypes_after = $this->em->getRepository('UserUserBundle:UserType')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals($count_events_before, $count_events_after);
        $this->assertEquals(($count_usertypes_before - 1), $count_usertypes_after);
        $this->assertEquals($count_users_before, $count_users_after);
    }

}
