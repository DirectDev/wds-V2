<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\EventFile;

class LoadEventFileData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;
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
    private $array_eventfile = array(
        2 => 'latin_sensation.jpg',
        3 => 'festival_cubano_orange.jpg',
        4 => 'latin_coktail.jpg',
        5 => 'dursin.jpg',
        6 => 'cuban_exclisve.jpg',
        7 => 'festival_kizomba.jpg',
        8 => 'interval.jpg',
        9 => 'latin_danse_trcg.jpg',
        10 => 'cubano_si_palmarium.jpg',
        11 => 'paris_bachata_festival.jpg',
        12 => 'paris_bachata_festival.jpg',
        13 => 'afro_latin_bfloor.jpg',
        14 => 'hacienda_des_saveurs.jpg',
        15 => 'kizango.jpg',
        16 => 'bachata_lundi_intervalle.jpg',
        17 => 'macondo.jpg',
        18 => 'macondo.jpg',
        19 => 'cubana bar.jpg',
        20 => 'COURTRAI TANGO.jpg',
        21 => 'COURTRAI TANGO.jpg',
        22 => 'COURTRAI TANGO.jpg',
        23 => 'cours_intervalle.jpg',
        24 => 'cours_intervalle.jpg',
        25 => 'salsa_st_quentin.jpg',
        26 => 'dursin.jpg',
        27 => 'dursin.jpg',
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

        foreach ($this->array_event as $value) {

            $EventFile = new EventFile();
            $Event = $this->getReference('event-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

            $file_number = rand(2, 27);
            $EventFile->setName($this->array_eventfile[$file_number]);

            $path_src = __DIR__ . "/../../../../../www/fixturesFiles/EventFile/" . $file_number;
            $path_dest = __DIR__ . "/../../../../../www/uploadedFiles/EventFile/" . $Event->getId();
            exec('mkdir "' . $path_dest . '" ');
            exec('xcopy "' . $path_src . '" "' . $path_dest . '" /s /e');

            $manager->persist($EventFile);

            $Event->addEventFile($EventFile);
            $manager->persist($Event);
        }



        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 50;
    }

}
