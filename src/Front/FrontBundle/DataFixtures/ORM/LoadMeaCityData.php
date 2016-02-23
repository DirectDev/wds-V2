<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\City;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;
use Front\FrontBundle\Entity\MeaCity;

class LoadMeaCityData extends AbstractFixture implements OrderedFixtureInterface {

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

        shuffle($this->array_city);

        foreach ($this->array_city as $city_reference) {
            $MeaCity = new MeaCity();
            $MeaCity->setCity($this->getReference('city-' . $city_reference));
            $MeaCity->setImage($city_reference);
            $MeaCity->setOrdre(rand(0, 100));
            $locale = $this->array_locale[rand(0, 1)];
            $MeaCity->translate($locale)->setDescription($this->array_description[rand(0, 19)]);
            $manager->persist($MeaCity);
            $MeaCity->mergeNewTranslations();
            $this->addReference('meacity-' . filter_var($city_reference, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $MeaCity);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 45;
    }

}
