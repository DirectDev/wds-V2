<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\EventType;

class LoadEventTypeData extends AbstractFixture implements OrderedFixtureInterface {

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

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 4;
    }

}
