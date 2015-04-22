<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Front\FrontBundle\Validator\Constraints as FormAssert;

/**
 * EventDate
 *
 * @ORM\Table(name="eventdate")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\EventDateRepository")
 * 
 * @FormAssert\DateCompare()
 */
class EventDate {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Date
     *
     * @ORM\Column(name="startdate", type="date", length=18)
     */
    private $startdate;

    /**
     * @var \Time
     *
     * @ORM\Column(name="starttime", type="time", nullable=true)
     */
    private $starttime;

    /**
     * @var \Date
     *
     * @ORM\Column(name="stopdate", type="date", nullable=true)
     */
    private $stopdate;

    /**
     * @var \Time
     *
     * @ORM\Column(name="stoptime", type="time", nullable=true)
     */
    private $stoptime;

    /**
     * @ORM\ManyToMany(targetEntity="Event", inversedBy="eventDates", cascade={"persist"})
     * @ORM\JoinTable(name="event_eventdates",
     * joinColumns={@ORM\JoinColumn(name="eEventDate_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="event_id", referencedColumnName="id")}
     * )
     */
    protected $events;

    public function __construct() {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return $this->startdate->format('Y-m-d')
                . ' ' . $this->starttime->format('H:i')
                . ' - ' . $this->stopdate->format('Y-m-d')
                . ' ' . $this->stoptime->format('H:i');
    }
    
    public function getEvent(){
        foreach ($this->events as $event) {
            return $event;            
        }
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set startdate
     *
     * @param \Date $startdate
     * @return EventDate
     */
    public function setStartdate($startdate) {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \Date
     */
    public function getStartdate() {
        return $this->startdate;
    }

    /**
     * Set stopdate
     *
     * @param \Date $stopdate
     * @return EventDate
     */
    public function setStopdate($stopdate) {
        $this->stopdate = $stopdate;

        return $this;
    }

    /**
     * Get stopdate
     *
     * @return \Date 
     */
    public function getStopdate() {
        return $this->stopdate;
    }

    /**
     * Add events
     *
     * @param \Front\FrontBundle\Entity\Event $events
     * @return EventDate
     */
    public function addEvent(\Front\FrontBundle\Entity\Event $events) {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \Front\FrontBundle\Entity\Event $events
     */
    public function removeEvent(\Front\FrontBundle\Entity\Event $events) {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents() {
        return $this->events;
    }

    /**
     * Set starttime
     *
     * @param \DateTime $starttime
     * @return EventDate
     */
    public function setStarttime($starttime) {
        $this->starttime = $starttime;

        return $this;
    }

    /**
     * Get starttime
     *
     * @return \DateTime 
     */
    public function getStarttime() {
        return $this->starttime;
    }

    /**
     * Set stoptime
     *
     * @param \DateTime $stoptime
     * @return EventDate
     */
    public function setStoptime($stoptime) {
        $this->stoptime = $stoptime;

        return $this;
    }

    /**
     * Get stoptime
     *
     * @return \DateTime 
     */
    public function getStoptime() {
        return $this->stoptime;
    }

}
