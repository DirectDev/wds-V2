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

            $Event = $this->getReference('event-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

            for ($i = 0; $i <= 3; $i++) {

                $EventFile = new EventFile();

                $file_number = rand(1, count($this->array_eventfile));
                $EventFile->setName($this->array_eventfile[$file_number]);

                $path_src = __DIR__ . "/../../../../../www/fixturesFiles/EventFile/" . $file_number;

                if ($this->detectOsWindows()) {
                    $path_dest = __DIR__ . "/../../../../../www/uploadedFiles/EventFile/" . $Event->getId() . "/large";
                    exec('mkdir "' . $path_dest . '" ');

                    try {
                        exec('xcopy "' . $path_src . '" "' . $path_dest . '" /s /e /c /y /q ');
                    } catch (Exception $ex) {
                        
                    }
                } else {
                    $path_dest = __DIR__ . "/../../../../../www/uploadedFiles/EventFile/" . $Event->getId() . "";
                    exec('mkdir "' . $path_dest . '" ');
                    $path_dest = __DIR__ . "/../../../../../www/uploadedFiles/EventFile/" . $Event->getId() . "/large";
                    exec('mkdir "' . $path_dest . '" ');

                    try {

                        exec('cp -v -R ' . $path_src . '/' . $file_number . '.jpg  ' . $path_dest);
                    } catch (Exception $ex) {
                        
                    }
                }

                $manager->persist($EventFile);

                $EventFile->setEvent($Event);
                $manager->persist($Event);
            }
        }



        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 50;
    }

    private function detectOsWindows() {
        if (stripos(PHP_OS, 'win') !== false)
            return true;
        return false;
    }

}
