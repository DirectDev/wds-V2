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

        $city_reference1 = $city_reference2 = $city_reference3 = null;
        for ($i = 0; $i <= 10; $i++) {

            if ($city_reference1 != $city_reference2 && $city_reference2 != $city_reference3 && $city_reference1 != $city_reference3)
                break;

            $city_reference1 = $this->array_city[rand(0, count($this->array_city) - 1)];
            $city_reference2 = $this->array_city[rand(0, count($this->array_city) - 1)];
            $city_reference3 = $this->array_city[rand(0, count($this->array_city) - 1)];
        }

        $MeaCity = new MeaCity();
        $MeaCity->setCity($this->getReference('city-'.$city_reference1));
        $MeaCity->setImage($city_reference1);
        $MeaCity->setOrdre(rand(0, 100));
        $locale = $this->array_locale[rand(0, 1)];
        $MeaCity->translate($locale)->setDescription($this->array_description[rand(0, 19)]);
        $manager->persist($MeaCity);
        $MeaCity->mergeNewTranslations();
        $this->addReference('meacity-' . filter_var($city_reference1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $MeaCity);

        $MeaCity = new MeaCity();
        $MeaCity->setCity($this->getReference('city-'.$city_reference2));
        $MeaCity->setImage($city_reference2);
        $MeaCity->setOrdre(rand(0, 100));
        $locale = $this->array_locale[rand(0, 1)];
        $MeaCity->translate($locale)->setDescription($this->array_description[rand(0, 19)]);
        $manager->persist($MeaCity);
        $MeaCity->mergeNewTranslations();
        $this->addReference('meacity-' . filter_var($city_reference2, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $MeaCity);

        $MeaCity = new MeaCity();
        $MeaCity->setCity($this->getReference('city-'.$city_reference3));
        $MeaCity->setImage($city_reference3);
        $MeaCity->setOrdre(rand(0, 100));
        $locale = $this->array_locale[rand(0, 1)];
        $MeaCity->translate($locale)->setDescription($this->array_description[rand(0, 19)]);
        $manager->persist($MeaCity);
        $MeaCity->mergeNewTranslations();
        $this->addReference('meacity-' . filter_var($city_reference3, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $MeaCity);


        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 45;
    }

}
