<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Translation\Translator;

class UserEnControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManagerh
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'en';
    private $client;
    private $clientLogged;
    private $username;
    private $email;
    private $password;
    private $PHP_AUTH_USER = 'Jerome';
    private $PHP_AUTH_PW = '1234';

    public function __construct() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->client = static::createClient();

        $this->router = $this->client->getContainer()->get('router');
        $this->translator = $this->client->getContainer()->get('translator');

        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));

        $this->username = 'new_' . $this->locale;
        $this->email = 'wds_' . $this->locale . '@yopmail.com';
        $this->password = '1234_' . $this->locale;

        $this->deleteData();
    }

    private function findNewUser() {
        return $this->em->getRepository('UserUserBundle:User')->findOneBy(
                        array(
                            'username' => $this->username,
                            'email' => $this->email,
                        )
        );
    }

    private function findAllUsers() {
        return $this->em->getRepository('UserUserBundle:User')->findAll();
    }

    private function findOneUser() {
        $i = 0;
        foreach ($this->findAllUsers() as $user) {
            $i++;
            if ($i == 1)
                continue;
            return $user;
        }
    }

    private function findOneUserType() {
        return $this->em->getRepository('UserUserBundle:UserType')->findOneByName('dancer');
    }

    private function findOneMusicType() {
        return $this->em->getRepository('FrontFrontBundle:MusicType')->findOneByName('salsa');
    }

    private function deleteData() {

        if ($User = $this->findNewUser())
            $this->em->remove($User);
        $this->em->flush();


        $Users = $this->findAllUsers();
        $oneUser = $this->findOneUser();
        foreach ($Users as $User) {
            if ($User->getLoves()->contains($oneUser))
                $User->removeLove($oneUser);
            $this->em->persist($User);
        }

        $this->em->flush();
    }

    public function testIndex() {
        $crawler = $this->client->request('GET', $this->router->generate('front_user_index', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_user_index', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testFilterAnonymous() {

        $crawler = $this->client->request('POST', $this->router->generate('front_user_index', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $form = $crawler->filter('#user_filter_form button[type=submit]')->form();
        $form['user_filter[search]'] = 'salsa';
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $UserType = $this->findOneUserType();
        $crawler = $this->client->request('POST', $this->router->generate('front_user_index', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $form = $crawler->filter('#user_filter_form button[type=submit]')->form();
        $form['user_filter[usertype]'] = $UserType->getTitle();
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $MusicType = $this->findOneMusicType();
        $crawler = $this->client->request('POST', $this->router->generate('front_user_index', array('_locale' => $this->locale)));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $form = $crawler->filter('#user_filter_form button[type=submit]')->form();
        $form['user_filter[musictype]'] = $MusicType->getTitle();
        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testFilterLoggued() {

        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_user_index', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $form = $crawler->filter('#user_filter_form button[type=submit]')->form();
        $form['user_filter[search]'] = 'salsa';
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $UserType = $this->findOneUserType();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_user_index', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $form = $crawler->filter('#user_filter_form button[type=submit]')->form();
        $form['user_filter[usertype]'] = $UserType->getTitle();
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $MusicType = $this->findOneMusicType();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_user_index', array('_locale' => $this->locale)));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $form = $crawler->filter('#user_filter_form button[type=submit]')->form();
        $form['user_filter[musictype]'] = $MusicType->getTitle();
        $crawler = $this->clientLogged->submit($form);
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testLoves() {
        $user = $this->findOneUser();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_user_loves', array(
                    'id' => $user->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testLove() {

        $user = $this->findOneUser();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_user_loves', array(
                    'id' => $user->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $form = $crawler->filter('form[name="form"]')->form();
        $crawler = $this->clientLogged->submit($form);

        $this->clientLogged->followRedirect();
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->em->refresh($user);
        $this->assertEquals(1, count($user->getLovesMe()));
    }

    public function testUnlove() {

        $user = $this->findOneUser();
        $crawler = $this->clientLogged->request('POST', $this->router->generate('front_user_loves', array(
                    'id' => $user->getId(),
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());

        $form = $crawler->filter('form[name="form"]')->form();
        $crawler = $this->clientLogged->submit($form);

        $this->clientLogged->followRedirect();
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->em->refresh($user);
        $this->assertEquals(0, count($user->getLovesMe()));
    }

    public function testShowPublic() {
        $users = $this->findAllUsers();
        foreach ($users as $user) {
            $crawler = $this->client->request('GET', $this->router->generate('front_user_show_public', array(
                        'username' => $user->getUsername(),
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->client->getResponse()->isSuccessful());

            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_user_show_public', array(
                        'username' => $user->getUsername(),
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testShowOverviews() {
        $users = $this->findAllUsers();
        foreach ($users as $user) {
            $crawler = $this->client->request('GET', $this->router->generate('front_user_show_overviews', array(
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->client->getResponse()->isSuccessful());

            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_user_show_overviews', array(
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testShowOverviewsProfile() {
        $users = $this->findAllUsers();
        foreach ($users as $user) {
            $crawler = $this->client->request('GET', $this->router->generate('front_user_show_overviews_profile', array(
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->client->getResponse()->isSuccessful());

            $crawler = $this->clientLogged->request('GET', $this->router->generate('front_user_show_overviews_profile', array(
                        'id' => $user->getId(),
                        '_locale' => $this->locale)
            ));
            $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        }
    }

    public function testPassedEvents() {

        $crawler = $this->client->request('GET', $this->router->generate('front_user_passed_events', array(
                    '_locale' => $this->locale)
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_user_passed_events', array(
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testNextEvents() {

        $crawler = $this->client->request('GET', $this->router->generate('front_user_next_events', array(
                    '_locale' => $this->locale)
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_user_next_events', array(
                    '_locale' => $this->locale)
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testShowPrivate() {
        $crawler = $this->client->request('GET', $this->router->generate('front_user_show_private', array(
                    '_locale' => $this->locale)
        ));
        $this->assertFalse($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('front_user_show_private', array(
                    '_locale' => $this->locale)
        ));
        $this->clientLogged->followRedirect();

        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("' . $this->PHP_AUTH_USER . '")')->count()
        );
    }

    public function testRegister() {

        $crawler = $this->client->request('GET', $this->router->generate('fos_user_registration_register', array(
                    '_locale' => $this->locale)
        ));
        $response = $this->client->getResponse();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $form = $crawler->filter('form.fos_user_registration_register')->form();

        $form['fos_user_registration_form[username]'] = $this->username;
        $form['fos_user_registration_form[email]'] = $this->email;
        $form['fos_user_registration_form[plainPassword][first]'] = $this->password;
        $form['fos_user_registration_form[plainPassword][second]'] = $this->password;

        $crawler = $this->client->submit($form);

        $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(1, count($this->findNewUser()));
    }

    public function testLogout() {
        $crawler = $this->client->request('GET', $this->router->generate('fos_user_security_logout', array(
                    '_locale' => $this->locale)
        ));
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testLogin() {

        $login = $this->translator->trans('security.login.submit', array(), 'FOSUserBundle', $this->locale);

        $crawler = $this->client->request('GET', $this->router->generate('fos_user_security_login', array(
                    '_locale' => $this->locale)
        ));
        $response = $this->client->getResponse();

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $this->assertContains($login, $response->getContent());

        $form = $crawler->selectButton($login)->form();

        $form['_username'] = $this->username;
        $form['_password'] = $this->password;

        $crawler = $this->client->submit($form);

        $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testCallbackUsernameTest() {

// registration

        $crawler = $this->client->request('GET', $this->router->generate('callback_username', array(
                    '_locale' => $this->locale,
                    'fos_user_registration_form[username]' => 'Jerome'
                        )
        ));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("false")')->count());

        $crawler = $this->client->request('GET', $this->router->generate('callback_username', array(
                    '_locale' => $this->locale,
                    'fos_user_registration_form[username]' => 'azer'
                        )
        ));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("true")')->count());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('callback_username', array(
                    '_locale' => $this->locale,
                    'fos_user_registration_form[username]' => 'Jerome'
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("true")')->count());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('callback_username', array(
                    '_locale' => $this->locale,
                    'fos_user_registration_form[username]' => 'azer'
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("true")')->count());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('callback_username', array(
                    '_locale' => $this->locale,
                    'fos_user_registration_form[username]' => 'jeje'
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertEquals(0, $crawler->filter('html:contains("false")')->count());



// edit user        

        $crawler = $this->client->request('GET', $this->router->generate('callback_username', array(
                    '_locale' => $this->locale,
                    'front_frontbundle_user_profile[username]' => 'Jerome'
                        )
        ));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("false")')->count());

        $crawler = $this->client->request('GET', $this->router->generate('callback_username', array(
                    '_locale' => $this->locale,
                    'front_frontbundle_user_profile[username]' => 'azer'
                        )
        ));
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("true")')->count());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('callback_username', array(
                    '_locale' => $this->locale,
                    'front_frontbundle_user_profile[username]' => 'Jerome'
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("true")')->count());

        $crawler = $this->clientLogged->request('GET', $this->router->generate('callback_username', array(
                    '_locale' => $this->locale,
                    'front_frontbundle_user_profile[username]' => 'azer'
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("true")')->count());


        $crawler = $this->clientLogged->request('GET', $this->router->generate('callback_username', array(
                    '_locale' => $this->locale,
                    'front_frontbundle_user_profile[username]' => 'jeje'
                        )
        ));
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertEquals(0, $crawler->filter('html:contains("false")')->count());
    }

}
