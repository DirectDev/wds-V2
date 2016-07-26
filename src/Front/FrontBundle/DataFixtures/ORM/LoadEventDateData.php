<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Front\FrontBundle\Entity\EventDate;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadEventDateData extends AbstractFixture implements OrderedFixtureInterface {

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
        
        if ($this->container->get('kernel')->getEnvironment() == 'prod')
            return;s

        for ($i = 0; $i <= 80; $i++)
            $this->loadEventDate($manager);

        $this->loadEmptyEventDate($manager);

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

    private function loadEmptyEventDate(ObjectManager $manager) {

        $add_start = rand(0, 10);
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

        $EventDate->addEvent($this->getReference('event-empty-event'));

        $manager->persist($EventDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 31;
    }

}
