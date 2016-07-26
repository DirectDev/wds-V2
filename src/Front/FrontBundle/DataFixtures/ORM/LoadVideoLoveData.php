<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\Video;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadVideoLoveData extends AbstractFixture implements OrderedFixtureInterface {

    use FixturesDataTrait;

    public function load(ObjectManager $manager) {
        
        if ($this->container->get('kernel')->getEnvironment() == 'prod')
            return;

        foreach ($this->array_video as $name => $url) {

            $Video = $this->getReference('video-' . filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

            $count = rand(0, 20);
            if (rand(0, 3))
                for ($i = 0; $i < $count; $i++) {
                    $user_reference = $this->array_user[rand(0, count($this->array_user) - 1)];
                    $User = $this->getReference('user-' . filter_var($user_reference, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
                    if (!$Video->getLovesMe()->contains($User))
                        $Video->addLovesMe($User);
                    $User = $this->getReference('user-to-delete');
                    if (!$Video->getLovesMe()->contains($User))
                        $Video->addLovesMe($User);
                }

            $manager->persist($Video);
        }

        foreach ($this->array_video_move as $name => $url) {

            $Video = $this->getReference('video-move-' . filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

            $count = rand(0, 20);
            if (rand(0, 3))
                for ($i = 0; $i < $count; $i++) {
                    $user_reference = $this->array_user[rand(0, count($this->array_user) - 1)];
                    $User = $this->getReference('user-' . filter_var($user_reference, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
                    if (!$Video->getLovesMe()->contains($User))
                        $Video->addLovesMe($User);
                }

            $manager->persist($Video);
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
