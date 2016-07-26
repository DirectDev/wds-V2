<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\Event;
use Front\FrontBundle\Entity\MusicType;
use Front\FrontBundle\Form\EventType;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadEventLoveData extends AbstractFixture implements OrderedFixtureInterface {

    use FixturesDataTrait;

    public function load(ObjectManager $manager) {
        
        $array_events = $this->array_event;
        $array_events[] = 'to-delete';
        $array_events[] = 'not-to-delete';

        foreach ($array_events as $value) {

            $Event = $this->getReference('event-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

            $count = rand(0, 20);
            if (rand(0, 3))
                for ($i = 0; $i < $count; $i++) {
                    $user_reference = $this->array_user[rand(0, count($this->array_user) - 1)];
                    $User = $this->getReference('user-' . filter_var($user_reference, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
                    if (!$Event->getLovesMe()->contains($User))
                        $Event->addLovesMe($User);
                    $User = $this->getReference('user-to-delete');
                    if (!$Event->getLovesMe()->contains($User))
                        $Event->addLovesMe($User);
                }

            $manager->persist($Event);
        }
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 38;
    }

}
