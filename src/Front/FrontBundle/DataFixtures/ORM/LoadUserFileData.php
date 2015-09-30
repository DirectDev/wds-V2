<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use User\UserBundle\Entity\UserFile;

class LoadUserFileData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;
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
    private $array_userfile = array(
        1 => 'Koala.jpg',
        2 => 'Jellyfish.jpg',
        3 => 'Jellyfish.jpg',
        4 => 'Koala.jpg',
        5 => 'Penguins.jpg',
        6 => 'Penguins.jpg',
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

        foreach ($this->array_user as $value) {

            $UserFile = new UserFile();
            $User = $this->getReference('user-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

            $file_number = rand(1, count($this->array_userfile));
            $UserFile->setName($this->array_userfile[$file_number]);

            $path_src = __DIR__ . "/../../../../../www/fixturesFiles/UserFile/" . $file_number;
            $path_dest = __DIR__ . "/../../../../../www/uploadedFiles/UserFile/" . $User->getId();
            exec('mkdir "' . $path_dest . '" ');
            exec('xcopy "' . $path_src . '" "' . $path_dest . '" /s /e');

            $manager->persist($UserFile);

            $User->addUserFile($UserFile);
            $manager->persist($User);
        }



        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 51;
    }

}
