<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\Video;

class LoadVideoData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;
    private $array_video = array(
        'https://www.youtube.com/watch?v=4P7V5yaQnmc',
        'https://vimeo.com/2374758',
        'http://www.dailymotion.com/video/x24ptwt_el-rubio-loco-libre-salsa_music',
        'https://www.youtube.com/watch?v=aVtWSZOttC0',
        'https://www.youtube.com/watch?v=6DWhBCofTCo',
        'https://www.youtube.com/watch?v=aV8dS2m9Adc',
        'https://www.youtube.com/watch?v=YXnjy5YlDwk',
        'https://www.youtube.com/watch?v=toLrTToaN0M',
        'https://www.youtube.com/watch?v=VMp55KH_3wo',
        'https://vimeo.com/109276707',
        'https://vimeo.com/127828813',
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

        foreach ($this->array_video as $url) {

            $count = rand(0, 5);
            for ($i = 0; $i <= $count; $i++) {

                $Video = new Video();
                $Video->setUrl($url);

                $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
                $Video->setUser($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

                $manager->persist($Video);
            }
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 60;
    }

}
