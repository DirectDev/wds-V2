<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\Tag;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadTagData extends AbstractFixture implements OrderedFixtureInterface {

    use FixturesDataTrait;

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

        foreach ($this->array_tag as $name) {


            $Tag = new Tag();
            $Tag->setName($name);

            $Tag->translate('en')->setTitle($name);
            $Tag->translate('fr')->setTitle($name);

            $manager->persist($Tag);

            $Tag->mergeNewTranslations();
            $this->addReference('tag-' . filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $Tag);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 09;
    }

}
