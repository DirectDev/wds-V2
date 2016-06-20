<?php

namespace Front\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Translation\Translator;

class UserDeleteControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManagerh
     */
    private $em;
    private $router;
    private $translator;
    private $locale = 'en';
    private $username;
    private $email;
    private $password;
    private $PHP_AUTH_PW = '1234';
    private $PHP_AUTH_USER_to_delete = 'to-delete';

    public function __construct() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();

        $this->clientToDelete = static::createClient(array(), array(
                    'PHP_AUTH_USER' => $this->PHP_AUTH_USER_to_delete,
                    'PHP_AUTH_PW' => $this->PHP_AUTH_PW
        ));


        $this->router = $this->clientToDelete->getContainer()->get('router');
        $this->translator = $this->clientToDelete->getContainer()->get('translator');

        $this->username = 'new_' . $this->locale;
        $this->email = 'wds_' . $this->locale . '@yopmail.com';
        $this->password = '1234_' . $this->locale;
    }

    private function findOneUserToDelete() {
        return $this->em->getRepository('UserUserBundle:User')->findOneByUsername('to-delete');
    }

    public function testDeleteLogged() {

        $update = $this->translator->trans('user.delete.button', array(), 'messages', $this->locale);

        $count_events_before = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_addresses_before = $this->em->getRepository('FrontFrontBundle:Address')->count();
        $count_musics_before = $this->em->getRepository('FrontFrontBundle:Music')->count();
        $count_videos_before = $this->em->getRepository('FrontFrontBundle:Video')->count();
        $count_users_before = $this->em->getRepository('UserUserBundle:User')->count();

        $user = $this->findOneUserToDelete();
        $this->assertNotNull($user);
        $crawler = $this->clientToDelete->request('DELETE', $this->router->generate('front_user_edit', array(
                    '_locale' => $this->locale,
                    'id' => $user->getId(),
                        )
        ));
        $this->assertTrue($this->clientToDelete->getResponse()->isSuccessful());

        $this->assertContains($update, $this->clientToDelete->getResponse()->getContent());

        $form = $crawler->filter('#userDeleteForm')->form();

        $crawler = $this->clientToDelete->submit($form);

        $this->assertTrue($this->clientToDelete->getResponse()->isRedirect());

        $this->assertEquals(0, count($this->em->getRepository('FrontFrontBundle:Event')->findOneByName("to-delete")));
        $this->assertEquals(0, count($this->em->getRepository('UserUserBundle:User')->findOneByUsername("to-delete")));
        $this->assertEquals(1, count($this->em->getRepository('FrontFrontBundle:Event')->findOneByName("not-to-delete")));


        $count_events_after = $this->em->getRepository('FrontFrontBundle:Event')->count();
        $count_addresses_after = $this->em->getRepository('FrontFrontBundle:Address')->count();
        $count_musics_after = $this->em->getRepository('FrontFrontBundle:Music')->count();
        $count_videos_after = $this->em->getRepository('FrontFrontBundle:Video')->count();
        $count_users_after = $this->em->getRepository('UserUserBundle:User')->count();

        $this->assertEquals(($count_events_before - 1), $count_events_after);
        $this->assertEquals(($count_addresses_before - 2), $count_addresses_after);
        $this->assertEquals(($count_musics_before - 1), $count_musics_after);
        $this->assertEquals(($count_videos_before - 1), $count_videos_after);
        $this->assertEquals(($count_users_before - 1), $count_users_after);
    }

}
