<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use User\UserBundle\Entity\UserFile;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadUserFileData extends AbstractFixture implements OrderedFixtureInterface {

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
