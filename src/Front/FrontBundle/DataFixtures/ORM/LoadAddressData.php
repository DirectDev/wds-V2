<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\Address;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadAddressData extends AbstractFixture implements OrderedFixtureInterface {

    use FixturesDataTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        foreach ($this->array_event as $value) {
            $Event = $this->getReference('event-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
            $Event->addAddress($this->addAddress($manager));
        }

        foreach ($this->array_user as $value) {
            $User = $this->getReference('user-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
            $User->addAddress($this->addAddress($manager));
        }

        $Event = $this->getReference('event-empty-event');
        $Event->addAddress($this->addEmptyAddress($manager));

        $User = $this->getReference('user-empty-user');
        $User->addAddress($this->addEmptyAddress($manager));

        $manager->flush();
    }

    private function addAddress(ObjectManager $manager) {
        $Address = new Address();

        $Address->setName($this->array_baseline[rand(0, count($this->array_baseline) - 1)]);
        $Address->setStreet($this->array_baseline[rand(0, count($this->array_baseline) - 1)]);
        $Address->setStreetComplement($this->array_baseline[rand(0, count($this->array_baseline) - 1)]);
        $Address->setPostcode($this->array_baseline[rand(0, count($this->array_baseline) - 1)]);

        $city_selected = $this->array_city[rand(0, count($this->array_city) - 1)];
        $City = $this->getReference('city-' . $city_selected);
        $latitude = $City->getLatitude() + rand(-100, 100) / 10000;
        $longitude = $City->getLongitude() + rand(-100, 100) / 10000;

        $Address->setCity($City->getName());
        $Address->setLatitude($latitude);
        $Address->setLongitude($longitude);

        if (in_array($city_selected, array('nice', 'paris', 'lille', 'marseille')))
            $Country = $this->getReference('country-FR');
        if (in_array($city_selected, array('san_francisco', 'new_york')))
            $Country = $this->getReference('country-US');
        if (in_array($city_selected, array('pekin')))
            $Country = $this->getReference('country-CH');
        if (in_array($city_selected, array('singapore')))
            $Country = $this->getReference('country-SG');
        if (in_array($city_selected, array('budapest')))
            $Country = $this->getReference('country-HU');
        if (in_array($city_selected, array('melbourne')))
            $Country = $this->getReference('country-AU');
        if (in_array($city_selected, array('rio')))
            $Country = $this->getReference('country-BR');
        $Address->setCountry($Country);

        $manager->persist($Address);

        return $Address;
    }

    private function addEmptyAddress(ObjectManager $manager) {
        $Address = new Address();

        $Address->setName($this->array_baseline[rand(0, count($this->array_baseline) - 1)]);
        $Address->setStreet($this->array_baseline[rand(0, count($this->array_baseline) - 1)]);
        $Address->setStreetComplement($this->array_baseline[rand(0, count($this->array_baseline) - 1)]);
        $Address->setPostcode($this->array_baseline[rand(0, count($this->array_baseline) - 1)]);

        $City = $this->getReference('city-empty-city');
        $latitude = $City->getLatitude() + rand(-100, 100) / 10000;
        $longitude = $City->getLongitude() + rand(-100, 100) / 10000;

        $Address->setCity($City->getName());
        $Address->setLatitude($latitude);
        $Address->setLongitude($longitude);

        $Country = $this->getReference('country-BR');
        $Address->setCountry($Country);

        $manager->persist($Address);

        return $Address;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 40;
    }

}
