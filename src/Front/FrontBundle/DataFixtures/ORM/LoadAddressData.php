<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\Address;

class LoadAddressData extends AbstractFixture implements OrderedFixtureInterface {

    private $array_city = array(
        'nice',
        'paris',
        'lille',
        'marseille',
        'singapore',
        'pekin',
        'san_francisco',
        'new_york',
        'budapest',
    );
    
    private $array_user = array(
        'salsa y passion',
        'salsa loca',
        'amor de salsa',
        'los bailadores',
        'Salsa de la calle',
        'rythmes latins',
        'sensualité et danse',
        'africasalsa',
        'dance & fun',
        'bests salsa teachers',
        'learn to dance',
        "latino's rythms",
        "john & miranda",
        "marc et sophie",
        "passionSalsa",
        "salsa y tu",
        "gente Loca",
        "los tamborinos",
        "the salsa players",
        "Mr Salsa",
        "dadee cuba",
        "los cubatoneros",
        "love salsa",
        "los cantadores",
        "El rojo",
        "B-sky",
        "Mac",
        "le Rezo",
        "Les quais",
        "Fishwarf",
        "The marina bar",
        "le Chateau",
        "The latino",
        "La salle des fêtes",
        "Drink's",
        "Champagne bar",
    );
    
    
    private $array_event = array(
            "Carnaval",
            "City Salsa Party",
            "Salsa Birthday",
            "Love night bachata",
            "Nuits latines",
            "la Clave",
            "Salsa Eve",
            "The kiz & kiss",
            "Salsa for you",
            "National Salsa days",
            "Time To Salsa",
            "Dance salsa for ever event",
        );
    private $array_baseline = array(
        'Maecenas porta nulla quis tempor hendrerit.',
        'Vestibulum sit amet lorem a urna iaculis ornare non eu lacus.',
        'Nam euismod diam mollis magna hendrerit, ac porta ante tincidunt.',
        'Ut sed nisl posuere, eleifend magna et, ornare augue.',
        'Suspendisse congue augue eu gravida egestas.',
        'Quisque ultrices erat at nibh mollis rhoncus.',
        'Sed viverra metus vitae accumsan sollicitudin.',
        'Cras fringilla lectus id ullamcorper ultricies.',
        'Proin faucibus libero vitae tempor bibendum.',
        'Duis suscipit mi id nisi mollis, vitae ultricies tellus ultricies.',
        'Phasellus volutpat lacus scelerisque libero mollis vulputate.',
        'Vestibulum quis elit eu tellus pretium fermentum eget quis est.',
        'Quisque semper risus et mauris vehicula vulputate.',
        'Maecenas sit amet justo mattis, eleifend nulla non, fringilla justo.',
        'Nulla aliquet nunc vitae sem pretium volutpat.',
        'Mauris finibus massa ac pellentesque scelerisque.',
        'Pellentesque id ligula in ipsum semper cursus.',
        'Integer commodo massa sed lorem consectetur, non commodo magna rhoncus.',
        'Vestibulum non ipsum pretium, fermentum ligula at, elementum odio.',
        'Vivamus tempus nisl ac urna rutrum aliquet.',
    );

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
        $latitude = $City->getLatitude() + rand(-100, 100)/10000;
        $longitude = $City->getLongitude() + rand(-100, 100)/10000;

        $Address->setCity($City->getSearchcity());
        $Address->setLatitude($latitude);
        $Address->setLongitude($longitude);
        
        if(in_array($city_selected, array('nice', 'paris', 'lille', 'marseille')))
                $Country = $this->getReference('country-FR');
        if(in_array($city_selected, array('san_francisco', 'new_york')))
                $Country = $this->getReference('country-US');
        if(in_array($city_selected, array('pekin')))
                $Country = $this->getReference('country-CH');
        if(in_array($city_selected, array('singapore')))
                $Country = $this->getReference('country-SG');
        if(in_array($city_selected, array('budapest')))
                $Country = $this->getReference('country-HU');
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
