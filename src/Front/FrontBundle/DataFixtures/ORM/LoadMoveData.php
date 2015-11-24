<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\Move;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadMoveData extends AbstractFixture implements OrderedFixtureInterface {

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

        foreach ($this->array_move as $key => $name) {

            $Move = new Move();
            $Move->setName($name);
            $Move->translate('en')->setTitle($name);
            $Move->translate('fr')->setTitle($name);

            $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
            $Move->setUser($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

            $video_selected = $this->array_video_move[$key];
            $Move->setVideo($this->getReference('video-move-' . $key));

            foreach ($this->array_tag as $tag_selected) {
                if (rand(0, 1))
                    $Move->addTag($this->getReference('tag-' . filter_var($tag_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
            }

            $manager->persist($Move);
            $Move->mergeNewTranslations();
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
