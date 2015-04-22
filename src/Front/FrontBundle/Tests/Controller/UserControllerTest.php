<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Constraints as Assert;

class UserControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $client;
    private $clientLogged;
    private $username = 'username1';
    private $email = 'email@username1.com';
    private $password = 'azerty';
    private $PHP_AUTH_USER = 'Jerome';
    private $PHP_AUTH_PW = '1234';

    public function __construct() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
        $this->deleteData();

        $this->client = static::createClient();
        $this->client->followRedirects();

        $this->clientLogged = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));
    }

    private function deleteData() {
        $users = $this->findUser();
        foreach ($users as $user)
            $this->em->remove($user);

        $this->em->flush();
    }

    private function findUsers() {
        return $this->em->getRepository('UserUserBundle:User')->findBy(
                        array(
                            'username' => $this->username,
                            'email' => $this->email,
                        )
        );
    }

    private function findUser() {
        return $this->em->getRepository('UserUserBundle:User')->findOneBy(
                        array(
                            'username' => $this->username,
                            'email' => $this->email,
                        )
        );
    }

    public function testShowPublic() {
        $crawler = $this->client->request('GET', '/profile/Jerome/1');
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $crawler = $this->clientLogged->request('GET', '/profile/Jerome/1');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
    }

    public function testShowPrivate() {
        $crawler = $this->client->request('GET', '/my-profile/');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(
                0, $crawler->filter('html:contains("' . $this->PHP_AUTH_USER . '")')->count()
        );

        $crawler = $this->clientLogged->request('GET', '/my-profile/');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("' . $this->PHP_AUTH_USER . '")')->count()
        );
    }

    public function testLogin() {

        $crawler = $this->client->request('GET', '/login');
        $response = $this->client->getResponse();

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $this->assertContains('Login', $response->getContent());

        $form = $crawler->selectButton('Login')->form();

        $form['_username'] = $this->username;
        $form['_password'] = $this->password;

        $crawler = $this->client->submit($form);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

//    public function testLogout() {
//        $crawler = $this->client->request('GET', '/logout');
//        $this->assertTrue($this->client->getResponse()->isSuccessful());
//    }

    public function testRegister() {

        $crawler = $this->client->request('GET', '/register');
        $response = $this->client->getResponse();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertContains('Register', $response->getContent());

        $form = $crawler->selectButton('Register')->form();

        $form['fos_user_registration_form[username]'] = $this->username;
        $form['fos_user_registration_form[email]'] = $this->email;
        $form['fos_user_registration_form[plainPassword][first]'] = $this->password;
        $form['fos_user_registration_form[plainPassword][second]'] = $this->password;

        $crawler = $this->client->submit($form);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(1, count($this->findUsers()));
    }

    public function testCallbackUsernameTest() {

        // registration
        
        $crawler = $this->client->request('GET', '/callback_username/en/?fos_user_registration_form%5Busername%5D=Jerome');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("false")')->count());

        $crawler = $this->client->request('GET', '/callback_username/en/?fos_user_registration_form%5Busername%5D=azer');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("true")')->count());

        $crawler = $this->clientLogged->request('GET', '/callback_username/en/?fos_user_registration_form%5Busername%5D=Jerome');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("true")')->count());

        $crawler = $this->clientLogged->request('GET', '/callback_username/en/?fos_user_registration_form%5Busername%5D=azer');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("true")')->count());

        $crawler = $this->clientLogged->request('GET', '/callback_username/en/?fos_user_registration_form%5Busername%5D=jeje');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("false")')->count());
        
        // edit user        
        
        $crawler = $this->client->request('GET', '/callback_username/en/?front_frontbundle_user%5Busername%5D=Jerome');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("false")')->count());

        $crawler = $this->client->request('GET', '/callback_username/en/?front_frontbundle_user%5Busername%5D=azer');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("true")')->count());

        $crawler = $this->clientLogged->request('GET', '/callback_username/en/?front_frontbundle_user%5Busername%5D=Jerome');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("true")')->count());

        $crawler = $this->clientLogged->request('GET', '/callback_username/en/?front_frontbundle_user%5Busername%5D=azer');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("true")')->count());

        $crawler = $this->clientLogged->request('GET', '/callback_username/en/?front_frontbundle_user%5Busername%5D=jeje');
        $this->assertTrue($this->clientLogged->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('html:contains("false")')->count());

    }

}
