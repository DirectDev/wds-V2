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

        foreach ($this->array_event as $value) {

            $Event = new Event();
            $Event->setName($value);

            $this->addMusicType($Event);
            $Event->setEventType($this->getReference('eventtype-' . $this->array_eventtype[rand(0, count($this->array_eventtype) - 1)]));

            $user_selected = $this->array_user[rand(0, count($this->array_user) - 1)];
            $Event->setUser($this->getReference('user-' . filter_var($user_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));


            $locale = $this->array_locale[rand(0, 1)];
            $Event->translate($locale)->setTitle($value);
            $Event->translate($locale)->setDescription($this->array_description[rand(0, 19)]);

            $manager->persist($Event);
            $Event->mergeNewTranslations();
            $this->addReference('event-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $Event);
        }

        $manager->flush();
    }

    private function addMusicType(Event $Event) {
        $count = rand(0, count($this->array_musictype) - 1);
        for ($i = 0; $i < $count; $i++) {
            if (rand(0, 1))
                $Event->addMusicType($this->getReference('musictype-' . $this->array_musictype[$i]));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 30;
    }

}
