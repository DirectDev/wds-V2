<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use User\UserBundle\Entity\User;
use Doctrine\Common\Collections\Criteria;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\EventRepository")
 */
class Event {

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="EventFile", mappedBy="event", cascade={"persist", "remove"})
     */
    protected $eventFiles;

    /**
     * @ORM\ManyToMany(targetEntity="Address", mappedBy="events", cascade={"persist"})
     */
    protected $addresses;

    /**
     * @ORM\ManyToMany(targetEntity="MusicType", inversedBy="events", cascade={"persist"})
     * @ORM\JoinTable(name="event_musictype",
     * joinColumns={@ORM\JoinColumn(name="event_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="musicType_id", referencedColumnName="id")}
     * )
     */
    protected $musicTypes;

    /**
     * @ORM\ManyToMany(targetEntity="EventDate", mappedBy="events", cascade={"persist"})
     * @ORM\OrderBy({"startdate" = "ASC"})
     */
    protected $eventDates;

    /**
     * @ORM\ManyToMany(targetEntity="EventType", inversedBy="events", cascade={"persist"})
     * @ORM\JoinTable(name="event_eventtype",
     * joinColumns={@ORM\JoinColumn(name="event_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="eventType_id", referencedColumnName="id")}
     * )
     */
    protected $eventTypes;

    /**
     * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\User", inversedBy="events")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * 
     * */
    protected $user;

    public function __call($method, $arguments) {
        $current = $this->proxyCurrentLocaleTranslation($method, $arguments);
        if ($current)
            return $current;
        foreach ($this->getTranslations() as $transation) {
            $value = call_user_func_array(
                    [$this->translate('fr'), $method], $arguments
            );
            if ($value)
                return $value;
        }
    }

    public function __construct() {
        $this->musicTypes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->eventDates = new \Doctrine\Common\Collections\ArrayCollection();
        $this->eventTypes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->eventFiles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getTitle() {
        return $this->__call('getTitle', array());
    }

    public function __toString() {
        return $this->getName();
    }

    public function getMusicTypesText() {
        $array = array();
        foreach ($this->getMusicTypes() as $musicType)
            $array[] = ucfirst($musicType->getTitle());
        return trim(implode(' - ', $array));
    }

    public function getMusicTypesClasses() {
        $array = array();
        foreach ($this->getMusicTypes() as $musicType)
            $array[] = strtolower($musicType->getTitle());
        return trim(implode(' ', $array));
    }

    public function getEventTypesText() {
        $array = array();
        foreach ($this->getEventTypes() as $eventType)
            $array[] = ucfirst($eventType->getTitle());
        return trim(implode(' - ', $array));
    }

    public function getDefaultImageUrl() {
        if ($this->getProfilePicture() && $this->getProfilePicture()->isImage())
            return $this->getProfilePicture()->getLargePathUri();

        if ($this->hasEventDateForDate(date('Y-m-d')))
            return "images/home_default/default_pink.png";

        return "images/home_default/default_blue.png";
    }

    public function getProfilePicture() {
        if (count($this->getEventFiles()))
            foreach ($this->getEventFiles() as $eventFile)
                if ($eventFile->isImage())
                    return $eventFile;
    }

    public function getProfilePictureUrl() {
        if ($this->getProfilePicture())
            return $this->getProfilePicture()->getMediumPathUri();
    }

    public function getAddress() {
        foreach ($this->addresses as $address)
            return $address;
    }

    public function getLatitude() {
        if ($this->getAddress())
            return $this->getAddress()->getLatitude();
    }

    public function getLongitude() {
        if ($this->getAddress())
            return $this->getAddress()->getLongitude();
    }

    public function getURI() {
        $uri = $this->name;
        foreach ($this->getMusicTypes() as $musicType) {
            $uri .= '-' . $musicType;
            break;
        }
        foreach ($this->getEventTypes() as $eventType) {
            $uri .= '-' . $eventType;
            break;
        }
        return $this->cleanURI($uri);
    }

    private function cleanURI($uri) {
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $uri);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
        $clean = urlencode($clean);

        return $clean;
    }

    public function isValid() {
        if (!$this->getAddress())
            return false;
        if (!$this->getAddress()->isValid())
            return false;

        return true;
    }

    public function isShownInSearchResults() {
        if (!$this->getNextEventDate())
            return false;
        if (!$this->isValid())
            return false;

        return true;
    }

    /*
     * return next eventdate after $date
     * $date -> 'Y-m-d'  
     */

    public function getNextEventDate($date = null) {

        $today = new \DateTime();
        if ($date)
            $today = new \DateTime($date);

        foreach ($this->eventDates as $eventDate) {
            if ($today->format('Y-m-d') == $eventDate->getStartDate()->format('Y-m-d'))
                return $eventDate;

            if ($eventDate->getStartdate() >= $today)
                return $eventDate;
        }
    }

    public function hasEventDateForDate($startdate) {
        foreach ($this->eventDates as $eventDate)
            if ($startdate == $eventDate->getStartDate()->format('Y-m-d'))
                return true;
        return false;
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
     * Set name
     *
     * @param string $name
     * @return Event
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Add musicTypes
     *
     * @param \Front\FrontBundle\Entity\MusicType $musicTypes
     * @return Event
     */
    public function addMusicType(\Front\FrontBundle\Entity\MusicType $musicTypes = null) {
        $musicTypes->addEvent($this);
        $this->musicTypes[] = $musicTypes;

        return $this;
    }

    public function setMusicType(ArrayCollection $addresses) {
        foreach ($musicTypes as $musicType) {
            $musicType->addEvent($this);
        }

        $this->musicTypes = $musicTypes;
    }

    /**
     * Remove musicTypes
     *
     * @param \Front\FrontBundle\Entity\MusicType $musicTypes
     */
    public function removeMusicType(\Front\FrontBundle\Entity\MusicType $musicTypes) {
        $this->musicTypes->removeElement($musicTypes);
    }

    /**
     * Get musicTypes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMusicTypes() {
        return $this->musicTypes;
    }

    /**
     * Add eventDates
     *
     * @param \Front\FrontBundle\Entity\EventDate $eventDates
     * @return Event
     */
    public function addEventDate(\Front\FrontBundle\Entity\EventDate $eventDates) {
        $eventDates->addEvent($this);
        $this->eventDates[] = $eventDates;

        return $this;
    }

    /**
     * Remove eventDates
     *
     * @param \Front\FrontBundle\Entity\EventDate $eventDates
     */
    public function removeEventDate(\Front\FrontBundle\Entity\EventDate $eventDates) {
        $this->eventDates->removeElement($eventDates);
    }

    /**
     * Get eventDates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventDates() {
        return $this->eventDates;
    }

    /**
     * Set user
     *
     * @param \User\UserBundle\Entity\User $user
     * @return Event
     */
    public function setUser(\User\UserBundle\Entity\User $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \User\UserBundle\Entity\User 
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Add addresses
     *
     * @param \Front\FrontBundle\Entity\Address $addresses
     * @return Event
     */
    public function addAddress(\Front\FrontBundle\Entity\Address $addresses) {
        $addresses->addEvent($this);
        $this->addresses[] = $addresses;

        return $this;
    }

    public function setAddresses(ArrayCollection $addresses) {
        foreach ($addresses as $address) {
            $address->addEvent($this);
        }

        $this->addresses = $addresses;
    }

    /**
     * Remove addresses
     *
     * @param \Front\FrontBundle\Entity\Address $addresses
     */
    public function removeAddress(\Front\FrontBundle\Entity\Address $addresses) {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddresses() {
        return $this->addresses;
    }

    /**
     * Add eventFiles
     *
     * @param \Front\FrontBundle\Entity\EventFile $eventFiles
     * @return Event
     */
    public function addEventFile(\Front\FrontBundle\Entity\EventFile $eventFiles) {
        $this->eventFiles[] = $eventFiles;

        return $this;
    }

    /**
     * Remove eventFiles
     *
     * @param \Front\FrontBundle\Entity\EventFile $eventFiles
     */
    public function removeEventFile(\Front\FrontBundle\Entity\EventFile $eventFiles) {
        $this->eventFiles->removeElement($eventFiles);
    }

    /**
     * Get eventFiles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventFiles() {
        return $this->eventFiles;
    }

    /**
     * Add eventType
     *
     * @param \Front\FrontBundle\Entity\EventType $eventType
     *
     * @return Event
     */
    public function addEventType(\Front\FrontBundle\Entity\EventType $eventType) {
        $this->eventTypes[] = $eventType;

        return $this;
    }

    /**
     * Remove eventType
     *
     * @param \Front\FrontBundle\Entity\EventType $eventType
     */
    public function removeEventType(\Front\FrontBundle\Entity\EventType $eventType) {
        $this->eventTypes->removeElement($eventType);
    }

    /**
     * Get eventTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventTypes() {
        return $this->eventTypes;
    }

}
