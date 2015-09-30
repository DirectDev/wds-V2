<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\EventDate;

class LoadEventDateData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;
    private $array_event = array(
        "Carnaval",
        "City Salsa Party",
        "Salsa Birthday",
        "Love night bachata",
        "Nuits latines",
        "la Clave",
        "Salsa Eve",
        "The kiz & kiss",
        "Salsa for you",
        "National Salsa days",
        "Time To Salsa",
        "Dance salsa for ever event",
    );

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

        for ($i = 0; $i <= 40; $i++)
            $this->loadEventDate($manager);

        $manager->flush();
    }

    private function loadEventDate(ObjectManager $manager) {

        $add_start = rand(0, 30);
        $add_stop = rand(0, 5);
        $add_time = rand(0, 4);

        $today = new \DateTime();
        $startdate = $today->add(new \DateInterval('P' . $add_start . 'D'));
        $stopdate = $today->add(new \DateInterval('P' . $add_start . 'D'));
        $stopdate = $stopdate->add(new \DateInterval('P' . $add_stop . 'D'));
        $starttime = new \DateTime('1970-01-01 ' . rand(0, 1) . rand(0, 9) . ':' . rand(0, 5) . rand(0, 9) . ':00');
        $stoptime = new \DateTime('1970-01-01 ' . rand(0, 1) . rand(0, 9) . ':' . rand(0, 5) . rand(0, 9) . ':00');
        $stoptime = $stoptime->add(new \DateInterval('PT' . $add_time . 'H'));

        $EventDate = new EventDate();
        $EventDate->setStartdate($startdate);
        $EventDate->setStopdate($stopdate);
        $EventDate->setStarttime($starttime);
        $EventDate->setStoptime($stoptime);

        $event_selected = $this->array_event[rand(0, count($this->array_event) - 1)];
        $EventDate->addEvent($this->getReference('event-' . filter_var($event_selected, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

        $manager->persist($EventDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 31;
    }

}
