<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\MusicType;

class LoadMusicTypeData extends AbstractFixture implements OrderedFixtureInterface {

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

        $MusicType = new MusicType();
        $MusicType->setName('Salsa');
        $MusicType->translate('en')->setTitle('Salsa');
        $MusicType->translate('fr')->setTitle('Salsa');
        $manager->persist($MusicType);
        $this->addReference('musictype-salsa', $MusicType);
        $MusicType->mergeNewTranslations();

        $MusicType = new MusicType();
        $MusicType->setName('Bachata');
        $MusicType->translate('en')->setTitle('Bachata');
        $MusicType->translate('fr')->setTitle('Bachata');
        $manager->persist($MusicType);
        $this->addReference('musictype-bachata', $MusicType);
        $MusicType->mergeNewTranslations();

        $MusicType = new MusicType();
        $MusicType->setName('Kizomba');
        $MusicType->translate('en')->setTitle('Kizomba');
        $MusicType->translate('fr')->setTitle('Kizomba');
        $manager->persist($MusicType);
        $this->addReference('musictype-kizomba', $MusicType);
        $MusicType->mergeNewTranslations();

        $MusicType = new MusicType();
        $MusicType->setName('Tango');
        $MusicType->translate('en')->setTitle('Tango');
        $MusicType->translate('fr')->setTitle('Tango');
        $manager->persist($MusicType);
        $this->addReference('musictype-tango', $MusicType);
        $MusicType->mergeNewTranslations();

        $MusicType = new MusicType();
        $MusicType->setName('Merengue');
        $MusicType->translate('en')->setTitle('Merengue');
        $MusicType->translate('fr')->setTitle('Merengue');
        $manager->persist($MusicType);
        $this->addReference('musictype-merengue', $MusicType);
        $MusicType->mergeNewTranslations();

        $MusicType = new MusicType();
        $MusicType->setName('Zouk');
        $MusicType->translate('en')->setTitle('Zouk');
        $MusicType->translate('fr')->setTitle('Zouk');
        $manager->persist($MusicType);
        $this->addReference('musictype-zouk', $MusicType);
        $MusicType->mergeNewTranslations();

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 3;
    }

}
