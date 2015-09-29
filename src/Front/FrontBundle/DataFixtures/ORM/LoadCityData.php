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
        $City->setSearchcity('nice');
        $City->setLatitude(43.7101728);
        $City->setLongitude(7.2619532);
        $manager->persist($City);
        $this->addReference('city-nice', $City);

        $City = new City();
        $City->setSearchcity('paris');
        $City->setLatitude(48.856614);
        $City->setLongitude(2.3522219);
        $manager->persist($City);
        $this->addReference('city-paris', $City);

        $City = new City();
        $City->setSearchcity('lille');
        $City->setLatitude(50.62925);
        $City->setLongitude(3.057256);
        $manager->persist($City);
        $this->addReference('city-lille', $City);

        $City = new City();
        $City->setSearchcity('marseille');
        $City->setLatitude(43.296482);
        $City->setLongitude(5.36978);
        $manager->persist($City);
        $this->addReference('city-marseille', $City);

        $City = new City();
        $City->setSearchcity('singapore');
        $City->setLatitude(1.352083);
        $City->setLongitude(103.819836);
        $manager->persist($City);
        $this->addReference('city-singapore', $City);

        $City = new City();
        $City->setSearchcity('pékin');
        $City->setLatitude(39.904211);
        $City->setLongitude(116.407395);
        $manager->persist($City);
        $this->addReference('city-pekin', $City);

        $City = new City();
        $City->setSearchcity('san francisco');
        $City->setLatitude(37.779276);
        $City->setLongitude(-122.419232);
        $manager->persist($City);
        $this->addReference('city-san_francisco', $City);

        $City = new City();
        $City->setSearchcity('new york');
        $City->setLatitude(40.714353);
        $City->setLongitude(-74.005973);
        $manager->persist($City);
        $this->addReference('city-new_york', $City);

        $City = new City();
        $City->setSearchcity('budapest');
        $City->setLatitude(47.4980100);
        $City->setLongitude(19.0399100);
        $manager->persist($City);
        $this->addReference('city-budapest', $City);
        
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 10;
    }

}
