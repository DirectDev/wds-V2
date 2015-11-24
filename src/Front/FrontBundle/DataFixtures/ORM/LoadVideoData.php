<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\Video;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadVideoData extends AbstractFixture implements OrderedFixtureInterface {

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

        foreach ($this->array_video as $url) {

            $count = rand(0, 5);
            for ($i = 0; $i <= $count; $i++) {

                $Video = new Video();
                $Video->setUrl($url);

                $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
                $Video->setUser($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

                foreach ($this->array_tag as $tag_selected) {
                if (rand(0, 1))
                    $Video->addTag($this->getReference('tag-' . filter_var($tag_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
            }


                $manager->persist($Video);
            }
        }

        foreach ($this->array_video_move as $key => $url) {

            $Video = new Video();
            $Video->setUrl($url);

            $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
            $Video->setUser($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

            foreach ($this->array_tag as $tag_selected) {
                if (rand(0, 1))
                    $Video->addTag($this->getReference('tag-' . filter_var($tag_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
            }

            $manager->persist($Video);
            $this->addReference('video-move-' . $key, $Video);
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
