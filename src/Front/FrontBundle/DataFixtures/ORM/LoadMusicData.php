<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\Music;

class LoadMusicData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;
    private $array_music = array(
        'https://soundcloud.com/peter-benjamin/marc-anthony-ahora-quien',
        'http://open.spotify.com/artist/5lsC3H1vh9YSRQckyGv0Up',
        'https://soundcloud.com/djnico-1/salsa-mix',
        'https://soundcloud.com/salsard/roby-peralta-yo-quiero-amarte-salsardcom2015',
        'https://soundcloud.com/sh-il-c-br-r/salsa-mix-para-bailar-rom',
        'https://open.spotify.com/track/0CSJp9bSIhAQ1J8uHTHebu',
        'https://open.spotify.com/track/7CsYHK2xk1n71pJr9geL1t',
        'https://open.spotify.com/track/5zGr7pFHaQI5f3TzhOXMKT',
        'https://open.spotify.com/track/5DO5ISJdDK2SluTCAEW1oS',
        'https://open.spotify.com/track/3Pacy6CMa8HPNVfeA3wkPQ',
        'https://open.spotify.com/track/5BwRO8sd8esywd8C7jsgIF',
        'https://open.spotify.com/track/2kKAtPzW5ulCuvfshjWNo6',
        'https://open.spotify.com/track/2HPneOQ0cxaIQbICMvvGED',
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

        foreach ($this->array_music as $url) {

            $count = rand(0, 5);
            for ($i = 0; $i <= $count; $i++) {
                $Music = new Music();
                $Music->setUrl($url);

                $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
                $Music->setUser($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

                $manager->persist($Music);
            }
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 61;
    }

}
