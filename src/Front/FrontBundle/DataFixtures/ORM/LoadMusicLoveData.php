<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\Music;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadMusicLoveData extends AbstractFixture implements OrderedFixtureInterface {

    use FixturesDataTrait;

    public function load(ObjectManager $manager) {

        foreach ($this->array_music as $name => $url) {

            $Music = $this->getReference('music-' . filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

            $count = rand(0, 20);
            if (rand(0, 3))
                for ($i = 0; $i < $count; $i++) {
                    $user_reference = $this->array_user[rand(0, count($this->array_user) - 1)];
                    $User = $this->getReference('user-' . filter_var($user_reference, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
                    if (!$Music->getLovesMe()->contains($User))
                        $Music->addLovesMe($User);
                }

            $manager->persist($Music);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 65;
    }

}
