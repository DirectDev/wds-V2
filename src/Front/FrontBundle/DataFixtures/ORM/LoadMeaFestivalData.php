<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\Event;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;
use Front\FrontBundle\Entity\MeaFestival;

class LoadMeaFestivalData extends AbstractFixture implements OrderedFixtureInterface {

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

        $festival_reference1 = $festival_reference2 = $festival_reference3 = null;
        for ($i = 0; $i <= 10; $i++) {

            if ($festival_reference1 != $festival_reference2 && $festival_reference2 != $festival_reference3 && $festival_reference1 != $festival_reference3)
                break;

            $festival_reference1 = $this->array_event[rand(0, count($this->array_event) - 1)];
            $festival_reference2 = $this->array_event[rand(0, count($this->array_event) - 1)];
            $festival_reference3 = $this->array_event[rand(0, count($this->array_event) - 1)];
        }

        $EventType = $this->getReference('eventtype-festival');

        $Event = $this->getReference('event-' . filter_var($festival_reference1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
        if (!$Event->getEventTypes()->contains($EventType))
            $Event->addEventType($EventType);
        $manager->persist($Event);
        $MeaFestival = new MeaFestival();
        $MeaFestival->setEvent($Event);
        $MeaFestival->setOrdre(rand(0, 100));
        $locale = $this->array_locale[rand(0, 1)];
        $MeaFestival->translate($locale)->setDescription($this->array_description[rand(0, 19)]);
        $manager->persist($MeaFestival);
        $MeaFestival->mergeNewTranslations();
        $this->addReference('meafestival-' . filter_var($festival_reference1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $MeaFestival);


        $Event = $this->getReference('event-' . filter_var($festival_reference2, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
        if (!$Event->getEventTypes()->contains($EventType))
            $Event->addEventType($EventType);
        $manager->persist($Event);
        $MeaFestival = new MeaFestival();
        $MeaFestival->setEvent($Event);
        $MeaFestival->setOrdre(rand(0, 100));
        $locale = $this->array_locale[rand(0, 1)];
        $MeaFestival->translate($locale)->setDescription($this->array_description[rand(0, 19)]);
        $manager->persist($MeaFestival);
        $MeaFestival->mergeNewTranslations();
        $this->addReference('meafestival-' . filter_var($festival_reference2, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $MeaFestival);

        $Event = $this->getReference('event-' . filter_var($festival_reference3, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
        if (!$Event->getEventTypes()->contains($EventType))
            $Event->addEventType($EventType);
        $manager->persist($Event);
        $MeaFestival = new MeaFestival();
        $MeaFestival->setEvent($Event);
        $MeaFestival->setOrdre(rand(0, 100));
        $locale = $this->array_locale[rand(0, 1)];
        $MeaFestival->translate($locale)->setDescription($this->array_description[rand(0, 19)]);
        $manager->persist($MeaFestival);
        $MeaFestival->mergeNewTranslations();
        $this->addReference('meafestival-' . filter_var($festival_reference3, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $MeaFestival);


        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 47;
    }

}
