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
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=true, options={"default":1})
     */
    private $published;

    /**
     * @var boolean
     *
     * @ORM\Column(name="form_filled_by_organizator", type="boolean", nullable=true, options={"default":0})
     */
    private $formFilledByOrganizator;

    /**
     * @var boolean
     *
     * @ORM\Column(name="footer", type="boolean", nullable=true)
     */
    private $footer;

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) 
     * @Assert\Length(
     *      min = 7
     * )
     */
    protected $facebook_id;

    /** @ORM\Column(name="facebook_link", type="string", length=255, nullable=true) */
    protected $facebook_link;

    /** @ORM\Column(name="facebook_picture_url", type="string", length=500, nullable=true) */
    protected $facebook_picture_url;

    /** @ORM\Column(name="google_link", type="string", length=255, nullable=true) */
    protected $google_link;

    /** @ORM\Column(name="twitter_link", type="string", length=255, nullable=true) */
    protected $twitter_link;

    /** @ORM\Column(name="linkedin_link", type="string", length=255, nullable=true) */
    protected $linkedin_link;

    /** @ORM\Column(name="flickr_link", type="string", length=255, nullable=true) */
    protected $flickr_link;

    /** @ORM\Column(name="tumblr_link", type="string", length=255, nullable=true) */
    protected $tumblr_link;

    /** @ORM\Column(name="instagram_link", type="string", length=255, nullable=true) */
    protected $instagram_link;

    /** @ORM\Column(name="vimeo_link", type="string", length=255, nullable=true) */
    protected $vimeo_link;

    /** @ORM\Column(name="youtube_link", type="string", length=255, nullable=true) */
    protected $youtube_link;

    /** @ORM\Column(name="baidu_link", type="string", length=255, nullable=true) */
    protected $baidu_link;

    /** @ORM\Column(name="xing_link", type="string", length=255, nullable=true) */
    protected $xing_link;

    /**
     * @ORM\OneToMany(targetEntity="EventFile", mappedBy="event", cascade={"persist", "remove"})
     */
    protected $eventFiles;

    /**
     * @ORM\ManyToMany(targetEntity="Address", mappedBy="events", cascade={"persist", "remove"})
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
     * @ORM\ManyToMany(targetEntity="EventDate", mappedBy="events", cascade={"persist", "remove"})
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

    /**
     * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\User", inversedBy="eventsPublished")
     * @ORM\JoinColumn(name="published_by_user_id", referencedColumnName="id")
     * 
     * */
    protected $publishedBy;

    /**
     * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\User", inversedBy="eventsOrganized")
     * @ORM\JoinColumn(name="organized_by_user_id", referencedColumnName="id")
     * 
     * */
    protected $organizedBy;

    /**
     * @ORM\ManyToMany(targetEntity="User\UserBundle\Entity\User", mappedBy="eventloves")     
     * */
    private $lovesMe;

    /**
     * @ORM\ManyToMany(targetEntity="User\UserBundle\Entity\User", mappedBy="eventPresences")     
     * */
    private $userPresents;

    /**
     * @ORM\OneToOne(targetEntity="Front\FrontBundle\Entity\MeaFestival", mappedBy="event", cascade={"remove"})
     * */
    private $meaFestival;

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
        $this->lovesMe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->userPresents = new \Doctrine\Common\Collections\ArrayCollection();
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
            return $this->getProfilePicture()->getLargePathUri();
        if ($this->isFacebookEvent() && $this->getFacebookPictureUrl())
            return $this->getFacebookPictureUrl();
    }

    public function getAddress() {
        foreach ($this->addresses as $address)
            return $address;
    }

    public function hasOneValidAddress() {
        foreach ($this->addresses as $address)
            if ($address->isValid())
                return true;
        return false;
    }

    public function getPlace() {
        if ($this->getAddress())
            return $this->getAddress()->getName();
    }

    public function getCity() {
        if ($this->getAddress())
            return $this->getAddress()->getCity();
    }

    public function getCountry() {
        if ($this->getAddress())
            return $this->getAddress()->getCountry();
    }

    public function getLatitude() {
        if ($this->getAddress())
            return $this->getAddress()->getLatitude();
    }

    public function getLongitude() {
        if ($this->getAddress())
            return $this->getAddress()->getLongitude();
    }

    public function getURI($locale = null) {
        $uri = $this->name;
        foreach ($this->getMusicTypes() as $musicType) {
            if ($locale)
                $music = $musicType->translate($locale)->getTitle();
            else
                $music = $musicType;
            $uri .= '-' . $music;
            break;
        }
        foreach ($this->getEventTypes() as $eventType) {
            if ($locale)
                $type = $eventType->translate($locale)->getTitle();
            else
                $type = $eventType;
            $uri .= '-' . $type;
            break;
        }
        return $this->cleanURI($uri);
    }

    private function cleanURI($uri) {
        $clean = preg_replace('#Ç#', 'C', $uri);
        $clean = preg_replace('#ç#', 'c', $clean);
        $clean = preg_replace('#è|é|ê|ë#', 'e', $clean);
        $clean = preg_replace('#È|É|Ê|Ë#', 'E', $clean);
        $clean = preg_replace('#à|á|â|ã|ä|å#', 'a', $clean);
        $clean = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $clean);
        $clean = preg_replace('#ì|í|î|ï#', 'i', $clean);
        $clean = preg_replace('#Ì|Í|Î|Ï#', 'I', $clean);
        $clean = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $clean);
        $clean = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $clean);
        $clean = preg_replace('#ù|ú|û|ü#', 'u', $clean);
        $clean = preg_replace('#Ù|Ú|Û|Ü#', 'U', $clean);
        $clean = preg_replace('#ý|ÿ#', 'y', $clean);
        $clean = preg_replace('#Ý#', 'Y', $clean);

        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
        $clean = urlencode($clean);

        return $clean;
    }

    public function isValid() {
        if (!$this->getAddress())
            return false;
        if (!$this->hasOneValidAddress())
            return false;

        return true;
    }

    public function isShownInSearchResults() {
        if (!$this->getPublished())
            return false;
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

    public function getNextEventDates($date = null, $limit = 5) {

        $today = new \DateTime();
        if ($date)
            $today = new \DateTime($date);

        $result = array();

        $count = 0;
        foreach ($this->eventDates as $eventDate) {
            if ($count >= $limit)
                break;

            if ($today->format('Y-m-d') == $eventDate->getStartDate()->format('Y-m-d')) {
                $result[] = $eventDate;
                $count++;
            } elseif ($eventDate->getStartdate() >= $today) {
                $result[] = $eventDate;
                $count++;
            }
        }

        return $result;
    }

    public function hasEventDateForDate($startdate) {
        foreach ($this->eventDates as $eventDate)
            if ($startdate == $eventDate->getStartDate()->format('Y-m-d'))
                return true;
        return false;
    }

    public function allowModificationByFacebookUser(User $user) {
        if (!$user->getFacebookId())
            return false;
        if ($this->getOrganizedBy() and $this->getOrganizedBy()->getFacebookId())
            if ($this->getOrganizedBy()->getFacebookId() != $user->getFacebookId())
                return false;
        if ($this->getPublishedBy() and $this->getPublishedBy()->getFacebookId())
            if ($this->getPublishedBy()->getFacebookId() != $user->getFacebookId())
                return false;
        if ($this->getUser() and $this->getUser()->getFacebookId())
            if ($this->getUser()->getFacebookId() != $user->getFacebookId())
                return false;
        return true;
    }

    public function allowModificationByUser(User $user) {
        if ($this->allowModificationByFacebookUser($user))
            return true;

        if ($this->getOrganizedBy() and $this->getOrganizedBy() == $user)
            return true;

        if ($this->getPublishedBy() and $this->getPublishedBy() == $user)
            return true;

        if ($this->getUser() and $this->getUser() == $user)
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

    /**
     * Add lovesMe
     *
     * @param \User\UserBundle\Entity\User $lovesMe
     *
     * @return Event
     */
    public function addLovesMe(\User\UserBundle\Entity\User $lovesMe) {
        $lovesMe->addEventlove($this);
        $this->lovesMe[] = $lovesMe;

        return $this;
    }

    /**
     * Remove lovesMe
     *
     * @param \User\UserBundle\Entity\User $lovesMe
     */
    public function removeLovesMe(\User\UserBundle\Entity\User $lovesMe) {
        $this->lovesMe->removeElement($lovesMe);
    }

    /**
     * Get lovesMe
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLovesMe() {
        return $this->lovesMe;
    }

    /**
     * Set meaFestival
     *
     * @param \Front\FrontBundle\Entity\MeaFestival $meaFestival
     *
     * @return Event
     */
    public function setMeaFestival(\Front\FrontBundle\Entity\MeaFestival $meaFestival = null) {
        $this->meaFestival = $meaFestival;

        return $this;
    }

    /**
     * Get meaFestival
     *
     * @return \Front\FrontBundle\Entity\MeaFestival
     */
    public function getMeaFestival() {
        return $this->meaFestival;
    }

    /**
     * Set facebookLink
     *
     * @param string $facebookLink
     *
     * @return Event
     */
    public function setFacebookLink($facebookLink) {
        $this->facebook_link = $facebookLink;

        return $this;
    }

    /**
     * Get facebookLink
     *
     * @return string
     */
    public function getFacebookLink() {
        return $this->facebook_link;
    }

    /**
     * Set googleLink
     *
     * @param string $googleLink
     *
     * @return Event
     */
    public function setGoogleLink($googleLink) {
        $this->google_link = $googleLink;

        return $this;
    }

    /**
     * Get googleLink
     *
     * @return string
     */
    public function getGoogleLink() {
        return $this->google_link;
    }

    /**
     * Set twitterLink
     *
     * @param string $twitterLink
     *
     * @return Event
     */
    public function setTwitterLink($twitterLink) {
        $this->twitter_link = $twitterLink;

        return $this;
    }

    /**
     * Get twitterLink
     *
     * @return string
     */
    public function getTwitterLink() {
        return $this->twitter_link;
    }

    /**
     * Set linkedinLink
     *
     * @param string $linkedinLink
     *
     * @return Event
     */
    public function setLinkedinLink($linkedinLink) {
        $this->linkedin_link = $linkedinLink;

        return $this;
    }

    /**
     * Get linkedinLink
     *
     * @return string
     */
    public function getLinkedinLink() {
        return $this->linkedin_link;
    }

    /**
     * Set flickrLink
     *
     * @param string $flickrLink
     *
     * @return Event
     */
    public function setFlickrLink($flickrLink) {
        $this->flickr_link = $flickrLink;

        return $this;
    }

    /**
     * Get flickrLink
     *
     * @return string
     */
    public function getFlickrLink() {
        return $this->flickr_link;
    }

    /**
     * Set tumblrLink
     *
     * @param string $tumblrLink
     *
     * @return Event
     */
    public function setTumblrLink($tumblrLink) {
        $this->tumblr_link = $tumblrLink;

        return $this;
    }

    /**
     * Get tumblrLink
     *
     * @return string
     */
    public function getTumblrLink() {
        return $this->tumblr_link;
    }

    /**
     * Set instagramLink
     *
     * @param string $instagramLink
     *
     * @return Event
     */
    public function setInstagramLink($instagramLink) {
        $this->instagram_link = $instagramLink;

        return $this;
    }

    /**
     * Get instagramLink
     *
     * @return string
     */
    public function getInstagramLink() {
        return $this->instagram_link;
    }

    /**
     * Set vimeoLink
     *
     * @param string $vimeoLink
     *
     * @return Event
     */
    public function setVimeoLink($vimeoLink) {
        $this->vimeo_link = $vimeoLink;

        return $this;
    }

    /**
     * Get vimeoLink
     *
     * @return string
     */
    public function getVimeoLink() {
        return $this->vimeo_link;
    }

    /**
     * Set youtubeLink
     *
     * @param string $youtubeLink
     *
     * @return Event
     */
    public function setYoutubeLink($youtubeLink) {
        $this->youtube_link = $youtubeLink;

        return $this;
    }

    /**
     * Get youtubeLink
     *
     * @return string
     */
    public function getYoutubeLink() {
        return $this->youtube_link;
    }

    /**
     * Add userPresent
     *
     * @param \User\UserBundle\Entity\User $userPresent
     *
     * @return Event
     */
    public function addUserPresent(\User\UserBundle\Entity\User $userPresent) {
        $userPresent->addEventPresence($this);
        $this->userPresents[] = $userPresent;

        return $this;
    }

    /**
     * Remove userPresent
     *
     * @param \User\UserBundle\Entity\User $userPresent
     */
    public function removeUserPresent(\User\UserBundle\Entity\User $userPresent) {
        $this->userPresents->removeElement($userPresent);
    }

    /**
     * Get userPresents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserPresents() {
        return $this->userPresents;
    }

    /**
     * Set publishedBy
     *
     * @param \User\UserBundle\Entity\User $publishedBy
     *
     * @return Event
     */
    public function setPublishedBy(\User\UserBundle\Entity\User $publishedBy = null) {
        $this->publishedBy = $publishedBy;

        return $this;
    }

    /**
     * Get publishedBy
     *
     * @return \User\UserBundle\Entity\User
     */
    public function getPublishedBy() {
        return $this->publishedBy;
    }

    /**
     * Set organizedBy
     *
     * @param \User\UserBundle\Entity\User $organizedBy
     *
     * @return Event
     */
    public function setOrganizedBy(\User\UserBundle\Entity\User $organizedBy = null) {
        $this->organizedBy = $organizedBy;

        return $this;
    }

    /**
     * Get organizedBy
     *
     * @return \User\UserBundle\Entity\User
     */
    public function getOrganizedBy() {
        return $this->organizedBy;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Event
     */
    public function setPublished($published) {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished() {
        return $this->published;
    }

    /**
     * Set baiduLink
     *
     * @param string $baiduLink
     *
     * @return Event
     */
    public function setBaiduLink($baiduLink) {
        $this->baidu_link = $baiduLink;

        return $this;
    }

    /**
     * Get baiduLink
     *
     * @return string
     */
    public function getBaiduLink() {
        return $this->baidu_link;
    }

    /**
     * Set xingLink
     *
     * @param string $xingLink
     *
     * @return Event
     */
    public function setXingLink($xingLink) {
        $this->xing_link = $xingLink;

        return $this;
    }

    /**
     * Get xingLink
     *
     * @return string
     */
    public function getXingLink() {
        return $this->xing_link;
    }

    /**
     * Set facebookId
     *
     * @param string $facebookId
     *
     * @return Event
     */
    public function setFacebookId($facebookId) {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebookId
     *
     * @return string
     */
    public function getFacebookId() {
        return $this->facebook_id;
    }

    /**
     * Set facebookPictureUrl
     *
     * @param string $facebookPictureUrl
     *
     * @return Event
     */
    public function setFacebookPictureUrl($facebookPictureUrl) {
        $this->facebook_picture_url = $facebookPictureUrl;

        return $this;
    }

    /**
     * Get facebookPictureUrl
     *
     * @return string
     */
    public function getFacebookPictureUrl() {
        return $this->facebook_picture_url;
    }

    /**
     * Set footer
     *
     * @param boolean $footer
     *
     * @return Event
     */
    public function setFooter($footer) {
        $this->footer = $footer;

        return $this;
    }

    /**
     * Get footer
     *
     * @return boolean
     */
    public function getFooter() {
        return $this->footer;
    }

    /**
     * Set formFilledByOrganizator
     *
     * @param boolean $formFilledByOrganizator
     *
     * @return Event
     */
    public function setFormFilledByOrganizator($formFilledByOrganizator) {
        $this->formFilledByOrganizator = $formFilledByOrganizator;

        return $this;
    }

    /**
     * Get formFilledByOrganizator
     *
     * @return boolean
     */
    public function getFormFilledByOrganizator() {
        return $this->formFilledByOrganizator;
    }

}
