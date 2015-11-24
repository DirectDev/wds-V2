<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\Music;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadMusicData extends AbstractFixture implements OrderedFixtureInterface {

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

        foreach ($this->array_music as $url) {

            $count = rand(0, 5);
            for ($i = 0; $i <= $count; $i++) {
                $Music = new Music();
                $Music->setUrl($url);

                $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
                $Music->setUser($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

                foreach ($this->array_tag as $tag_selected) {
                if (rand(0, 1))
                        $Music->addTag($this->getReference('tag-' . filter_var($tag_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
                }

                $manager->persist($Music);
            }
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 61;
    }

}
