<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\EventFile;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadEventFileData extends AbstractFixture implements OrderedFixtureInterface {

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

        foreach ($this->array_event as $value) {

            $EventFile = new EventFile();
            $Event = $this->getReference('event-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

            $file_number = rand(1, count($this->array_eventfile));
            $EventFile->setName($this->array_eventfile[$file_number]);

            $path_src = __DIR__ . "/../../../../../www/fixturesFiles/EventFile/" . $file_number;
            $path_dest = __DIR__ . "/../../../../../www/uploadedFiles/EventFile/" . $Event->getId();
            exec('mkdir "' . $path_dest . '" ');
            exec('xcopy "' . $path_src . '" "' . $path_dest . '" /s /e');

            $manager->persist($EventFile);

//            $Event->addEventFile($EventFile);
            $EventFile->setEvent($Event);
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
