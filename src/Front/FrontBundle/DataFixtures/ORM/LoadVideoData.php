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

        foreach ($this->array_video as $name => $url) {

            $Video = new Video();
            $Video->setUrl($url);
            $Video->setCreatedAt(new \DateTime());

            $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
            $Video->setUser($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

            foreach ($this->array_tag as $tag_selected) {
                if (rand(0, 1))
                    $Video->addTag($this->getReference('tag-' . filter_var($tag_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
            }


            $manager->persist($Video);
            $Video->mergeNewTranslations();
            $this->addReference('video-' . filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $Video);
        }

        foreach ($this->array_video_move as $name => $url) {

            $Video = new Video();
            $Video->setUrl($url);

            $Video->setName($name);
            $Video->translate('en')->setTitle($name);
            $Video->translate('fr')->setTitle($name);
            $Video->setMove(true);
            $Video->setCreatedAt(new \DateTime());

            $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
            $Video->setUser($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

            foreach ($this->array_tag as $tag_selected) {
                if (rand(0, 1))
                    $Video->addTag($this->getReference('tag-' . filter_var($tag_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
            }

            $manager->persist($Video);
            $Video->mergeNewTranslations();
            $this->addReference('video-move-' . filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $Video);
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
