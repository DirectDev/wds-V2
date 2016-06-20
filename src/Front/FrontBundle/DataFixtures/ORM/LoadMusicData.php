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

        foreach ($this->array_music as $name => $url) {

            $Music = new Music();
            $Music->setUrl($url);
            $Music->setName($name);
            $Music->translate('en')->setTitle($name);
            $Music->translate('fr')->setTitle($name);
            $Music->setCreatedAt(new \DateTime());

            $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
            $Music->setUser($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

            foreach ($this->array_tag as $tag_selected) {
                if (rand(0, 1))
                    $Music->addTag($this->getReference('tag-' . filter_var($tag_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
            }

            $manager->persist($Music);
            $Music->mergeNewTranslations();
            $this->addReference('music-' . filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $Music);
        }

        $manager->flush();
        
        $this->loadUserToDelete($manager);
    }

    public function loadUserToDelete(ObjectManager $manager) {

        $name = 'to-delete';
        $url = 'url-to-delete';

        $Music = new Music();
        $Music->setUrl($url);
        $Music->setName($name);
        $Music->translate('en')->setTitle($name);
        $Music->translate('fr')->setTitle($name);
        $Music->setCreatedAt(new \DateTime());

        $Music->setUser($this->getReference('user-to-delete'));

        foreach ($this->array_tag as $tag_selected) {
            if (rand(0, 1))
                $Music->addTag($this->getReference('tag-' . filter_var($tag_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
        }

        $manager->persist($Music);
        $Music->mergeNewTranslations();
        $this->addReference('music-' . filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $Music);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 61;
    }

}
