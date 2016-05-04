<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\City;

class LoadCityData extends AbstractFixture implements OrderedFixtureInterface {

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

        $City = new City();
        $City->setName('paris');
        $City->setLatitude(48.856614);
        $City->setLongitude(2.3522219);
        if (rand(0, 4))
            $City->setFooter(true);
        $manager->persist($City);
        $this->addReference('city-paris', $City);

        $City = new City();
        $City->setName('lille');
        $City->setLatitude(50.62925);
        $City->setLongitude(3.057256);
        if (rand(0, 4))
            $City->setFooter(true);
        $manager->persist($City);
        $this->addReference('city-lille', $City);

        $City = new City();
        $City->setName('singapore');
        $City->setLatitude(1.352083);
        $City->setLongitude(103.819836);
        if (rand(0, 4))
            $City->setFooter(true);
        $manager->persist($City);
        $this->addReference('city-singapore', $City);

        $City = new City();
        $City->setName('pékin');
        $City->setLatitude(39.904211);
        $City->setLongitude(116.407395);
        if (rand(0, 4))
            $City->setFooter(true);
        $manager->persist($City);
        $this->addReference('city-pekin', $City);

        $City = new City();
        $City->setName('san francisco');
        $City->setLatitude(37.779276);
        $City->setLongitude(-122.419232);
        if (rand(0, 4))
            $City->setFooter(true);
        $manager->persist($City);
        $this->addReference('city-san_francisco', $City);

        $City = new City();
        $City->setName('new york');
        $City->setLatitude(40.714353);
        $City->setLongitude(-74.005973);
        if (rand(0, 4))
            $City->setFooter(true);
        $manager->persist($City);
        $this->addReference('city-new_york', $City);

        $City = new City();
        $City->setName('budapest');
        $City->setLatitude(47.4980100);
        $City->setLongitude(19.0399100);
        if (rand(0, 4))
            $City->setFooter(true);
        $manager->persist($City);
        $this->addReference('city-budapest', $City);

        $City = new City();
        $City->setName('melbourne');
        $City->setLatitude(-37.8140000);
        $City->setLongitude(144.9633200);
        if (rand(0, 4))
            $City->setFooter(true);
        $manager->persist($City);
        $this->addReference('city-melbourne', $City);

        $City = new City();
        $City->setName('rio');
        $City->setLatitude(-22.9027800);
        $City->setLongitude(-43.2075000);
        if (rand(0, 4))
            $City->setFooter(true);
        $manager->persist($City);
        $this->addReference('city-rio', $City);

        $City = new City();
        $City->setName('empty-city');
        $City->setLatitude(-29.9027800);
        $City->setLongitude(-33.2075000);
        if (rand(0, 4))
            $City->setFooter(true);
        $manager->persist($City);
        $this->addReference('city-empty-city', $City);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 10;
    }

}
