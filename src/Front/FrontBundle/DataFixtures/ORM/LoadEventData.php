<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\Event;
use Front\FrontBundle\Entity\MusicType;
use Front\FrontBundle\Form\EventType;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadEventData extends AbstractFixture implements OrderedFixtureInterface {

    use FixturesDataTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $i = 0;
        foreach ($this->array_event as $value) {

            $Event = new Event();
            $Event->setName($value);

            $this->addMusicType($Event);
            $this->addEventType($Event);

            if ($i == 0)
                $user_selected = $this->array_user[0];
            else
                $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
            $Event->setUser($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

            if (rand(0, 1))
                $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
            $Event->setOrganizedBy($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

            if (rand(0, 1))
                $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
            $Event->setPublishedBy($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

            $Event->setPublished(true);
            if (rand(0, 4))
                $Event->setFooter(true);

            $locale = $this->array_locale[rand(0, 1)];
            $Event->translate($locale)->setTitle($value);
            $Event->translate($locale)->setDescription($this->array_description[rand(0, 19)]);

            $manager->persist($Event);
            $Event->mergeNewTranslations();
            $this->addReference('event-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $Event);
            $i++;
        }

        $manager->flush();

        $this->loadEmpty($manager);
        $this->loadToDeleteTest($manager);
    }

    private function loadEmpty(ObjectManager $manager) {

        $name = 'empty-event';
        $Event = new Event();
        $Event->setName($name);

        $Event->setUser($this->getReference('user-empty-user'));

        $manager->persist($Event);
        $this->addReference('event-' . filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $Event);


        $manager->flush();
    }

    private function addMusicType(Event $Event) {
        $count = rand(0, count($this->array_musictype) - 1);
        for ($i = 0; $i < $count; $i++) {
            if (rand(0, 1))
                $Event->addMusicType($this->getReference('musictype-' . $this->array_musictype[$i]));
        }
    }

    private function addEventType(Event $Event) {
        $count = rand(0, count($this->array_eventtype) - 1);
        for ($i = 0; $i < $count; $i++) {
            if (rand(0, 1))
                $Event->addEventType($this->getReference('eventtype-' . $this->array_eventtype[$i]));
        }
    }

    private function loadToDeleteTest(ObjectManager $manager) {

        $name = 'to-delete';
        $Event = new Event();
        $Event->setName($name);
        $Event->setUser($this->getReference('user-to-delete'));
        $this->addMusicType($Event);
        $this->addEventType($Event);
            $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
        $Event->setOrganizedBy($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
            $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
        $Event->setPublishedBy($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
        $Event->setPublished(true);
        $manager->persist($Event);
        $this->addReference('event-' . filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $Event);

        $name = 'not-to-delete';
        $Event = new Event();
        $Event->setName($name);

        $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
        $Event->setUser($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
        $Event->setPublishedBy($this->getReference('user-to-delete'));
        $Event->setOrganizedBy($this->getReference('user-to-delete'));

        $Event->setPublished(true);
        $manager->persist($Event);
        $this->addReference('event-' . filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $Event);


        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 30;
    }

}
