<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Front\FrontBundle\Entity\EventType;

class LoadEventTypeData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

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
            $EventType = new EventType();
            $EventType->setName('for-test');
            $EventType->translate('en')->setTitle('for-test');
            $EventType->translate('fr')->setTitle('for-test');
            $manager->persist($EventType);
            $this->addReference('eventtype-for-test', $EventType);
            $EventType->mergeNewTranslations();
        }

        $EventType = new EventType();
        $EventType->setName('Party');
        $EventType->translate('en')->setTitle('Party');
        $EventType->translate('fr')->setTitle('Soirée');
        $manager->persist($EventType);
        $this->addReference('eventtype-party', $EventType);
        $EventType->mergeNewTranslations();

        $EventType = new EventType();
        $EventType->setName('Festival');
        $EventType->translate('en')->setTitle('Festival');
        $EventType->translate('fr')->setTitle('Festival');
        $manager->persist($EventType);
        $this->addReference('eventtype-festival', $EventType);
        $EventType->mergeNewTranslations();

        $EventType = new EventType();
        $EventType->setName('Workshop');
        $EventType->translate('en')->setTitle('Workshop');
        $EventType->translate('fr')->setTitle('Cours');
        $manager->persist($EventType);
        $this->addReference('eventtype-workshop', $EventType);
        $EventType->mergeNewTranslations();

        $EventType = new EventType();
        $EventType->setName('Introduction');
        $EventType->translate('en')->setTitle('Introduction');
        $EventType->translate('fr')->setTitle('Initiation');
        $manager->persist($EventType);
        $this->addReference('eventtype-lesson', $EventType);
        $EventType->mergeNewTranslations();

        $EventType = new EventType();
        $EventType->setName('Show');
        $EventType->translate('en')->setTitle('Show');
        $EventType->translate('fr')->setTitle('Show');
        $manager->persist($EventType);
        $this->addReference('eventtype-show', $EventType);
        $EventType->mergeNewTranslations();

        $EventType = new EventType();
        $EventType->setName('Concert');
        $EventType->translate('en')->setTitle('Concert');
        $EventType->translate('fr')->setTitle('Concert');
        $manager->persist($EventType);
        $this->addReference('eventtype-concert', $EventType);
        $EventType->mergeNewTranslations();

        $EventType = new EventType();
        $EventType->setName('Congress');
        $EventType->translate('en')->setTitle('Congress');
        $EventType->translate('fr')->setTitle('Congress');
        $manager->persist($EventType);
        $this->addReference('eventtype-congress', $EventType);
        $EventType->mergeNewTranslations();

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 4;
    }

}
