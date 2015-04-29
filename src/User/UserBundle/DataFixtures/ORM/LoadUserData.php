<?php

namespace User\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use User\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $User = new User();
        $User->setUsername('Jerome');
        $User->setPassword('1234');
        $User->setEmail('serviceclient@directdev.fr');
        $User->addRole('ROLE_SUPER_ADMIN');

        $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($User)
        ;
        $User->setPassword($encoder->encodePassword('1234', $User->getSalt()));

        $manager->persist($User);
        $manager->flush();
    }

}
