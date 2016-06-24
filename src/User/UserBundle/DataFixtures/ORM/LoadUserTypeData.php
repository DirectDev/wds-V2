<?php

namespace User\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use User\UserBundle\Entity\UserType;

class LoadUserTypeData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

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

        if ($this->container->get('kernel')->getEnvironment() == 'test') {
            $UserType = new UserType();
            $UserType->setName('for-test');
            $UserType->translate('en')->setTitle('for-test');
            $UserType->translate('fr')->setTitle('for-test');
            $manager->persist($UserType);
            $this->addReference('usertype-for-test', $UserType);
            $UserType->mergeNewTranslations();
        }

        $UserType = new UserType();
        $UserType->setName('dancer');
        $UserType->translate('en')->setTitle('Dancer');
        $UserType->translate('fr')->setTitle('Danseur/Danseuse');
        $manager->persist($UserType);
        $this->addReference('usertype-dancer', $UserType);
        $UserType->mergeNewTranslations();

        $UserType = new UserType();
        $UserType->setName('teacher');
        $UserType->translate('en')->setTitle('Teacher');
        $UserType->translate('fr')->setTitle('Professeur');
        $manager->persist($UserType);
        $this->addReference('usertype-teacher', $UserType);
        $UserType->mergeNewTranslations();

        $UserType = new UserType();
        $UserType->setName('artist');
        $UserType->translate('en')->setTitle('Artist');
        $UserType->translate('fr')->setTitle('Artiste');
        $manager->persist($UserType);
        $this->addReference('usertype-artist', $UserType);
        $UserType->mergeNewTranslations();

        $UserType = new UserType();
        $UserType->setName('bar');
        $UserType->translate('en')->setTitle('Bar/Club');
        $UserType->translate('fr')->setTitle('Bar/Club');
        $manager->persist($UserType);
        $this->addReference('usertype-bar', $UserType);
        $UserType->mergeNewTranslations();

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 2;
    }

}
