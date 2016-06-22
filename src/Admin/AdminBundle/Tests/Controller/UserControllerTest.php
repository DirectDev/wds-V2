<?php

namespace Admin\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase {

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
    private $username = null;
    private $updated_username = null;
    private $description = null;
    private $email = null;

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

        $this->email = 'email@test.com';
        $this->username = '_admin_user_username_' . $this->locale;
        $this->updated_username = $this->username . '_updated';
        $this->description = 'description';
    }

    private function findAllUsers() {
        return $this->em->getRepository('UserUserBundle:User')->findBy(array('footer' => true), null, 1);
    }

    private function findOneUser() {
        foreach ($this->findAllUsers() as $user)
            return $user;
    }

    public function testIndex() {
        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_user', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testUpdate() {


        $user = $this->findOneUser();
        $this->assertNotNull($user);

        /*         * **** Update ***** */
        $update = $this->translator->trans('admin.update', array(), 'AdminBundle', $this->locale);

        $crawler = $this->clientLogged->request('GET', $this->router->generate('admin_user_edit', array(
                    '_locale' => $this->locale,
                    'id' => $user->getId()
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($update)->form();

        $form['aab_user[username]'] = $this->updated_username;

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();

        $this->em->refresh($user);
        $this->assertEquals($this->updated_username, $user->getUsername());
    }

    public function testDelete() {

        $delete = $this->translator->trans('admin.delete', array(), 'AdminBundle', $this->locale);

        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $user = $this->findOneUser();
        $this->assertNotNull($user);
        $crawler = $this->clientLogged->request('DELETE', $this->router->generate('admin_user_edit', array(
                    '_locale' => $this->locale,
                    'id' => $user->getId(),
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $this->assertContains($delete, $this->clientLogged->getResponse()->getContent());

        $form = $crawler->selectButton($delete)->form();

        $crawler = $this->clientLogged->submit($form);

        $response = $this->clientLogged->getResponse();
        var_dump($response->getContent());
        $this->assertTrue($this->clientLogged->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('UserUserBundle:User')->findOneById($user->getId())));

        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals(($count_users_before - 1), $count_users_after);
    }

}
