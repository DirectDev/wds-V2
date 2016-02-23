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

        foreach ($this->array_user_bar as $value) {

            $User = $this->getReference('user-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

            for ($i = 0; $i <= 3; $i++) {

                $UserFile = new UserFile();

                $file_number = rand(1, count($this->array_userfile_bar));
                $UserFile->setName($this->array_userfile_bar[$file_number]);

                $path_src = __DIR__ . "/../../../../../www/fixturesFiles/UserFile/bar/" . $file_number;
                
                if ($this->detectOsWindows()) {
                    $path_dest = __DIR__ . "/../../../../../www/uploadedFiles/UserFile/" . $User->getId() . "/large";
                    exec('mkdir "' . $path_dest . '" ');

                    try {
                        exec('xcopy "' . $path_src . '" "' . $path_dest . '" /s /e /c /y /q ');
                    } catch (Exception $ex) {
                        
                    }
                } else {
                    $path_dest = __DIR__ . "/../../../../../www/uploadedFiles/UserFile/" . $User->getId() . "";
                    exec('mkdir "' . $path_dest . '" ');
                    $path_dest = __DIR__ . "/../../../../../www/uploadedFiles/UserFile/" . $User->getId() . "/large";
                    exec('mkdir "' . $path_dest . '" ');

                    try {

                        exec('cp -v -R ' . $path_src . '/' . $file_number . '.jpg  ' . $path_dest);
                    } catch (Exception $ex) {
                        
                    }
                }

                $manager->persist($UserFile);

                $User->addUserFile($UserFile);
                $manager->persist($User);
            }
        }

        foreach ($this->array_user as $value) {

            if (in_array($value, $this->array_userfile_bar))
                continue;

            $User = $this->getReference('user-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

            for ($i = 0; $i <= 3; $i++) {

                $UserFile = new UserFile();

                $file_number = rand(1, count($this->array_userfile));
                $UserFile->setName($this->array_userfile[$file_number]);

                $path_src = __DIR__ . "/../../../../../www/fixturesFiles/UserFile/" . $file_number;
                
                if ($this->detectOsWindows()) {
                    $path_dest = __DIR__ . "/../../../../../www/uploadedFiles/UserFile/" . $User->getId() . "/large";
                    exec('mkdir "' . $path_dest . '" ');

                    try {
                        exec('xcopy "' . $path_src . '" "' . $path_dest . '" /s /e /c /y /q ');
                    } catch (Exception $ex) {
                        
                    }
                } else {
                    $path_dest = __DIR__ . "/../../../../../www/uploadedFiles/UserFile/" . $User->getId() . "";
                    exec('mkdir "' . $path_dest . '" ');
                    $path_dest = __DIR__ . "/../../../../../www/uploadedFiles/UserFile/" . $User->getId() . "/large";
                    exec('mkdir "' . $path_dest . '" ');

                    try {

                        exec('cp -v -R ' . $path_src . '/' . $file_number . '.jpg  ' . $path_dest);
                    } catch (Exception $ex) {
                        
                    }
                }

                $manager->persist($UserFile);

                $User->addUserFile($UserFile);
                $manager->persist($User);
            }
        }



        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 51;
    }

    private function detectOsWindows() {
        if (stripos(PHP_OS, 'win') !== false)
            return true;
        return false;
    }

}
