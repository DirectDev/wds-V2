<?php

namespace User\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Front\FrontBundle\Entity\Event;
use Front\FrontBundle\Entity\Address;
use Front\FrontBundle\Entity\MusicType;
use Front\FrontBundle\Entity\Music;
use Front\FrontBundle\Entity\Video;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="User\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser {

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(name="facebook_link", type="string", length=255, nullable=true) */
    protected $facebook_link;

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

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) 
     * @Assert\Length(
     *      min = 7
     * )
     */
    protected $facebook_id;

    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;

    /** @ORM\Column(name="google_id", type="string", length=255, nullable=true) */
    protected $google_id;

    /** @ORM\Column(name="google_access_token", type="string", length=255, nullable=true) */
    protected $google_access_token;

    /** @ORM\Column(name="display_counter", type="integer", nullable=true) */
    protected $display_counter;

    /**
     * @ORM\OneToMany(targetEntity="UserFile", mappedBy="user")
     */
    protected $userFiles;

    /**
     * @ORM\OneToMany(targetEntity="Front\FrontBundle\Entity\Event", mappedBy="user")
     * @ORM\OrderBy({"id" = "DESC"})
     * */
    private $events;
    /**
     * @ORM\OneToMany(targetEntity="Front\FrontBundle\Entity\Event", mappedBy="publishedBy")
     * @ORM\OrderBy({"id" = "DESC"})
     * */
    private $eventsPublished;
    /**
     * @ORM\OneToMany(targetEntity="Front\FrontBundle\Entity\Event", mappedBy="organizedBy")
     * @ORM\OrderBy({"id" = "DESC"})
     * */
    private $eventsOrganized;

    /**
     * @ORM\ManyToMany(targetEntity="Front\FrontBundle\Entity\Address", mappedBy="users", cascade={"persist"})
     */
    protected $addresses;

    /**
     * @ORM\ManyToMany(targetEntity="Front\FrontBundle\Entity\MusicType", inversedBy="users", cascade={"persist"})
     * @ORM\JoinTable(name="user_musictype",
     * joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="musicType_id", referencedColumnName="id")}
     * )
     */
    protected $musicTypes;

    /**
     * @ORM\ManyToMany(targetEntity="UserType", inversedBy="users", cascade={"persist"})
     * @ORM\JoinTable(name="user_usertype",
     * joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="userType_id", referencedColumnName="id")}
     * )
     */
    protected $userTypes;

    /**
     * @ORM\OneToMany(targetEntity="Front\FrontBundle\Entity\Music", mappedBy="user")
     */
    protected $musics;

    /**
     * @ORM\OneToMany(targetEntity="Front\FrontBundle\Entity\Video", mappedBy="user")
     */
    protected $videos;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="loves")
     * */
    private $lovesMe;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="lovesMe")
     * @ORM\JoinTable(name="love",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="love_user_id", referencedColumnName="id")}
     *      )
     * */
    private $loves;

    /**
     * @ORM\ManyToMany(targetEntity="Front\FrontBundle\Entity\Event", inversedBy="lovesMe")
     * @ORM\JoinTable(name="event_love",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="love_event_id", referencedColumnName="id")}
     *      )
     * */
    private $eventloves;

    /**
     * @ORM\ManyToMany(targetEntity="Front\FrontBundle\Entity\Video", inversedBy="lovesMe")
     * @ORM\JoinTable(name="video_love",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="love_video_id", referencedColumnName="id")}
     *      )
     * */
    private $videoloves;

    /**
     * @ORM\ManyToMany(targetEntity="Front\FrontBundle\Entity\Music", inversedBy="lovesMe")
     * @ORM\JoinTable(name="music_love",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="love_music_id", referencedColumnName="id")}
     *      )
     * */
    private $musicloves;

    /**
     * @ORM\OneToOne(targetEntity="Front\FrontBundle\Entity\MeaUser", mappedBy="user")
     * */
    private $meaUser;

    /**
     * @ORM\ManyToMany(targetEntity="Front\FrontBundle\Entity\Event", inversedBy="userPresents")
     * @ORM\JoinTable(name="event_presence",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="presence_event_id", referencedColumnName="id")}
     *      )
     * */
    private $eventPresences;

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
        parent::__construct();

        $this->userFiles = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->eventsPublished = new ArrayCollection();
        $this->eventsOrganized = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->musicTypes = new ArrayCollection();
        $this->userTypes = new ArrayCollection();
        $this->musics = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->eventloves = new ArrayCollection();
        $this->videoloves = new ArrayCollection();
        $this->musicloves = new ArrayCollection();
        $this->loves = new ArrayCollection();
        $this->lovesMe = new ArrayCollection();
        $this->eventPresences = new ArrayCollection();
    }

    public function isFacebookUser() {
        if ($this->facebook_id)
            return true;
        return false;
    }

    public function isGoolgeUser() {
        if ($this->google_id)
            return true;
        return false;
    }

    public function getProfilePicture() {
        foreach ($this->getUserFiles() as $UserFile)
            if ($UserFile->isImage())
                return $UserFile;
    }

    public function getProfilePictureUrl() {
        if ($this->isFacebookUser())
            return 'https://graph.facebook.com/' . $this->getFacebookId() . '/picture?type=large';

        if ($this->getProfilePicture())
            return $this->getProfilePicture()->getLargePathUri();
        
        return '/images/no_user_picture.jpg';
    }

    public function getAddress() {
        foreach ($this->addresses as $address)
            return $address;
    }

    public function getCity() {
        if ($this->getAddress())
            return $this->getAddress()->getCity();
        return '';
    }

    public function getCountry() {
        if ($this->getAddress())
            return $this->getAddress()->getCountry();
        return '';
    }

    public function getUserType() {
        foreach ($this->userTypes as $userType)
            return $userType;
    }

    public function getMusicType() {
        foreach ($this->musicTypes as $musicType)
            return $musicType;
    }

    public function getMusicTypesText() {
        $array = array();
        foreach ($this->getMusicTypes() as $musicType)
            $array[] = ucfirst($musicType->getTitle());
        return implode(' - ', $array);
    }

    public function getUserTypesText() {
        $array = array();
        foreach ($this->getUserTypes() as $userType)
            $array[] = ucfirst($userType->getTitle());
        return implode(' - ', $array);
    }

    public function isDancer() {
        foreach ($this->userTypes as $userType)
            if ($userType->getName() == 'dancer')
                return true;
        return false;
    }

    public function isTeacher() {
        foreach ($this->userTypes as $userType)
            if ($userType->getName() == 'teacher')
                return true;
        return false;
    }

    public function isArtist() {
        foreach ($this->userTypes as $userType)
            if ($userType->getName() == 'artist')
                return true;
        return false;
    }

    public function isBar() {
        foreach ($this->userTypes as $userType)
            if ($userType->getName() == 'bar')
                return true;
        return false;
    }

    public function incrementDisplayCounter() {
        $this->display_counter++;
    }

    public function loveVideo(Video $video) {
        if ($this->getVideoloves()->contains($video))
            return true;
        return false;
    }

    public function loveMusic(Music $music) {
        if ($this->getMusicloves()->contains($music))
            return true;
        return false;
    }

    public function loveEvent(Event $event) {
        if ($this->getEventloves()->contains($event))
            return true;
        return false;
    }

    public function loveUser(User $user) {
        if ($this->getLoves()->contains($user))
            return true;
        return false;
    }

    public function textForNavbarHighlight() {
        return $this->getUsername() . ' / ' . ucfirst($this->getCity());
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
     * Set facebook_id
     *
     * @param string $facebookId
     * @return User
     */
    public function setFacebookId($facebookId) {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebook_id
     *
     * @return string 
     */
    public function getFacebookId() {
        return $this->facebook_id;
    }

    /**
     * Set facebook_access_token
     *
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken) {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebook_access_token
     *
     * @return string 
     */
    public function getFacebookAccessToken() {
        return $this->facebook_access_token;
    }

    /**
     * Set google_id
     *
     * @param string $googleId
     * @return User
     */
    public function setGoogleId($googleId) {
        $this->google_id = $googleId;

        return $this;
    }

    /**
     * Get google_id
     *
     * @return string 
     */
    public function getGoogleId() {
        return $this->google_id;
    }

    /**
     * Set google_access_token
     *
     * @param string $googleAccessToken
     * @return User
     */
    public function setGoogleAccessToken($googleAccessToken) {
        $this->google_access_token = $googleAccessToken;

        return $this;
    }

    /**
     * Get google_access_token
     *
     * @return string 
     */
    public function getGoogleAccessToken() {
        return $this->google_access_token;
    }

    /**
     * Add userFiles
     *
     * @param \User\UserBundle\Entity\UserFile $userFiles
     * @return User
     */
    public function addUserFile(\User\UserBundle\Entity\UserFile $userFiles) {
        $userFiles->setUser($this);
        $this->userFiles[] = $userFiles;

        return $this;
    }

    /**
     * Remove userFiles
     *
     * @param \User\UserBundle\Entity\UserFile $userFiles
     */
    public function removeUserFile(\User\UserBundle\Entity\UserFile $userFiles) {
        $this->userFiles->removeElement($userFiles);
    }

    /**
     * Get userFiles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserFiles() {
        return $this->userFiles;
    }

    /**
     * Add events
     *
     * @param \Front\FrontBundle\Entity\Event $events
     * @return User
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
     * Set facebook_link
     *
     * @param string $facebookLink
     * @return User
     */
    public function setFacebookLink($facebookLink) {
        $this->facebook_link = $facebookLink;

        return $this;
    }

    /**
     * Get facebook_link
     *
     * @return string 
     */
    public function getFacebookLink() {
        return $this->facebook_link;
    }

    /**
     * Set google_link
     *
     * @param string $googleLink
     * @return User
     */
    public function setGoogleLink($googleLink) {
        $this->google_link = $googleLink;

        return $this;
    }

    /**
     * Get google_link
     *
     * @return string 
     */
    public function getGoogleLink() {
        return $this->google_link;
    }

    /**
     * Set twitter_link
     *
     * @param string $twitterLink
     * @return User
     */
    public function setTwitterLink($twitterLink) {
        $this->twitter_link = $twitterLink;

        return $this;
    }

    /**
     * Get twitter_link
     *
     * @return string 
     */
    public function getTwitterLink() {
        return $this->twitter_link;
    }

    /**
     * Set linkedin_link
     *
     * @param string $linkedinLink
     * @return User
     */
    public function setLinkedinLink($linkedinLink) {
        $this->linkedin_link = $linkedinLink;

        return $this;
    }

    /**
     * Get linkedin_link
     *
     * @return string 
     */
    public function getLinkedinLink() {
        return $this->linkedin_link;
    }

    /**
     * Set flickr_link
     *
     * @param string $flickrLink
     * @return User
     */
    public function setFlickrLink($flickrLink) {
        $this->flickr_link = $flickrLink;

        return $this;
    }

    /**
     * Get flickr_link
     *
     * @return string 
     */
    public function getFlickrLink() {
        return $this->flickr_link;
    }

    /**
     * Add addresses
     *
     * @param \Front\FrontBundle\Entity\Address $addresses
     * @return User
     */
    public function addAddress(\Front\FrontBundle\Entity\Address $addresses) {
        $addresses->addUser($this);
        $this->addresses[] = $addresses;

        return $this;
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
     * Add musicTypes
     *
     * @param \Front\FrontBundle\Entity\MusicType $musicTypes
     * @return User
     */
    public function addMusicType(\Front\FrontBundle\Entity\MusicType $musicTypes) {
        $this->musicTypes[] = $musicTypes;

        return $this;
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
     * Add userTypes
     *
     * @param \User\UserBundle\Entity\UserType $userTypes
     * @return User
     */
    public function addUserType(\User\UserBundle\Entity\UserType $userTypes) {
        $this->userTypes[] = $userTypes;

        return $this;
    }

    /**
     * Remove userTypes
     *
     * @param \User\UserBundle\Entity\UserType $userTypes
     */
    public function removeUserType(\User\UserBundle\Entity\UserType $userTypes) {
        $this->userTypes->removeElement($userTypes);
    }

    /**
     * Get userTypes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserTypes() {
        return $this->userTypes;
    }

    /**
     * Set tumblr_link
     *
     * @param string $tumblrLink
     * @return User
     */
    public function setTumblrLink($tumblrLink) {
        $this->tumblr_link = $tumblrLink;

        return $this;
    }

    /**
     * Get tumblr_link
     *
     * @return string 
     */
    public function getTumblrLink() {
        return $this->tumblr_link;
    }

    /**
     * Set instagram_link
     *
     * @param string $instagramLink
     * @return User
     */
    public function setInstagramLink($instagramLink) {
        $this->instagram_link = $instagramLink;

        return $this;
    }

    /**
     * Get instagram_link
     *
     * @return string 
     */
    public function getInstagramLink() {
        return $this->instagram_link;
    }

    /**
     * Set vimeo_link
     *
     * @param string $vimeoLink
     * @return User
     */
    public function setVimeoLink($vimeoLink) {
        $this->vimeo_link = $vimeoLink;

        return $this;
    }

    /**
     * Get vimeo_link
     *
     * @return string 
     */
    public function getVimeoLink() {
        return $this->vimeo_link;
    }

    /**
     * Set youtube_link
     *
     * @param string $youtubeLink
     * @return User
     */
    public function setYoutubeLink($youtubeLink) {
        $this->youtube_link = $youtubeLink;

        return $this;
    }

    /**
     * Get youtube_link
     *
     * @return string 
     */
    public function getYoutubeLink() {
        return $this->youtube_link;
    }

    /**
     * Add musics
     *
     * @param \Front\FrontBundle\Entity\Music $musics
     * @return User
     */
    public function addMusic(\Front\FrontBundle\Entity\Music $musics) {
        $musics->addUser($this);
        $this->musics[] = $musics;

        return $this;
    }

    /**
     * Remove musics
     *
     * @param \Front\FrontBundle\Entity\Music $musics
     */
    public function removeMusic(\Front\FrontBundle\Entity\Music $musics) {
        $this->musics->removeElement($musics);
    }

    /**
     * Get musics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMusics() {
        return $this->musics;
    }

    /**
     * Add videos
     *
     * @param \Front\FrontBundle\Entity\Video $videos
     * @return User
     */
    public function addVideo(\Front\FrontBundle\Entity\Video $videos) {
        $videos->addUser($this);
        $this->videos[] = $videos;

        return $this;
    }

    /**
     * Remove videos
     *
     * @param \Front\FrontBundle\Entity\Video $videos
     */
    public function removeVideo(\Front\FrontBundle\Entity\Video $videos) {
        $this->videos->removeElement($videos);
    }

    /**
     * Get videos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVideos() {
        return $this->videos;
    }

    /**
     * Set displayCounter
     *
     * @param integer $displayCounter
     *
     * @return User
     */
    public function setDisplayCounter($displayCounter) {
        $this->display_counter = $displayCounter;

        return $this;
    }

    /**
     * Get displayCounter
     *
     * @return integer
     */
    public function getDisplayCounter() {
        return $this->display_counter;
    }

    /**
     * Add lovesMe
     *
     * @param \User\UserBundle\Entity\User $lovesMe
     *
     * @return User
     */
    public function addLovesMe(\User\UserBundle\Entity\User $lovesMe) {
        $lovesMe->addLove($this);
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
     * Add love
     *
     * @param \User\UserBundle\Entity\User $love
     *
     * @return User
     */
    public function addLove(\User\UserBundle\Entity\User $love) {
        $this->loves[] = $love;

        return $this;
    }

    /**
     * Remove love
     *
     * @param \User\UserBundle\Entity\User $love
     */
    public function removeLove(\User\UserBundle\Entity\User $love) {
        $this->loves->removeElement($love);
    }

    /**
     * Get loves
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLoves() {
        return $this->loves;
    }

    /**
     * Add eventlove
     *
     * @param \Front\FrontBundle\Entity\Event $eventlove
     *
     * @return User
     */
    public function addEventlove(\Front\FrontBundle\Entity\Event $eventlove) {
        $this->eventloves[] = $eventlove;

        return $this;
    }

    /**
     * Remove eventlove
     *
     * @param \Front\FrontBundle\Entity\Event $eventlove
     */
    public function removeEventlove(\Front\FrontBundle\Entity\Event $eventlove) {
        $this->eventloves->removeElement($eventlove);
    }

    /**
     * Get eventloves
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventloves() {
        return $this->eventloves;
    }

    /**
     * Set meaUser
     *
     * @param \Front\FrontBundle\Entity\MeaUser $meaUser
     *
     * @return User
     */
    public function setMeaUser(\Front\FrontBundle\Entity\MeaUser $meaUser = null) {
        $this->meaUser = $meaUser;

        return $this;
    }

    /**
     * Get meaUser
     *
     * @return \Front\FrontBundle\Entity\MeaUser
     */
    public function getMeaUser() {
        return $this->meaUser;
    }

    /**
     * Add videolove
     *
     * @param \Front\FrontBundle\Entity\Video $videolove
     *
     * @return User
     */
    public function addVideolove(\Front\FrontBundle\Entity\Video $videolove) {
        $this->videoloves[] = $videolove;

        return $this;
    }

    /**
     * Remove videolove
     *
     * @param \Front\FrontBundle\Entity\Video $videolove
     */
    public function removeVideolove(\Front\FrontBundle\Entity\Video $videolove) {
        $this->videoloves->removeElement($videolove);
    }

    /**
     * Get videoloves
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVideoloves() {
        return $this->videoloves;
    }

    /**
     * Add musiclove
     *
     * @param \Front\FrontBundle\Entity\Music $musiclove
     *
     * @return User
     */
    public function addMusiclove(\Front\FrontBundle\Entity\Music $musiclove) {
        $this->musicloves[] = $musiclove;

        return $this;
    }

    /**
     * Remove musiclove
     *
     * @param \Front\FrontBundle\Entity\Music $musiclove
     */
    public function removeMusiclove(\Front\FrontBundle\Entity\Music $musiclove) {
        $this->musicloves->removeElement($musiclove);
    }

    /**
     * Get musicloves
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMusicloves() {
        return $this->musicloves;
    }

    /**
     * Add eventPresence
     *
     * @param \Front\FrontBundle\Entity\Event $eventPresence
     *
     * @return User
     */
    public function addEventPresence(\Front\FrontBundle\Entity\Event $eventPresence) {
        $this->eventPresences[] = $eventPresence;

        return $this;
    }

    /**
     * Remove eventPresence
     *
     * @param \Front\FrontBundle\Entity\Event $eventPresence
     */
    public function removeEventPresence(\Front\FrontBundle\Entity\Event $eventPresence) {
        $this->eventPresences->removeElement($eventPresence);
    }

    /**
     * Get eventPresences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventPresences() {
        return $this->eventPresences;
    }


    /**
     * Add eventsPublished
     *
     * @param \Front\FrontBundle\Entity\Event $eventsPublished
     *
     * @return User
     */
    public function addEventsPublished(\Front\FrontBundle\Entity\Event $eventsPublished)
    {
        $this->eventsPublished[] = $eventsPublished;

        return $this;
    }

    /**
     * Remove eventsPublished
     *
     * @param \Front\FrontBundle\Entity\Event $eventsPublished
     */
    public function removeEventsPublished(\Front\FrontBundle\Entity\Event $eventsPublished)
    {
        $this->eventsPublished->removeElement($eventsPublished);
    }

    /**
     * Get eventsPublished
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventsPublished()
    {
        return $this->eventsPublished;
    }

    /**
     * Add eventsOrganized
     *
     * @param \Front\FrontBundle\Entity\Event $eventsOrganized
     *
     * @return User
     */
    public function addEventsOrganized(\Front\FrontBundle\Entity\Event $eventsOrganized)
    {
        $this->eventsOrganized[] = $eventsOrganized;

        return $this;
    }

    /**
     * Remove eventsOrganized
     *
     * @param \Front\FrontBundle\Entity\Event $eventsOrganized
     */
    public function removeEventsOrganized(\Front\FrontBundle\Entity\Event $eventsOrganized)
    {
        $this->eventsOrganized->removeElement($eventsOrganized);
    }

    /**
     * Get eventsOrganized
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventsOrganized()
    {
        return $this->eventsOrganized;
    }

    /**
     * Set baiduLink
     *
     * @param string $baiduLink
     *
     * @return User
     */
    public function setBaiduLink($baiduLink)
    {
        $this->baidu_link = $baiduLink;

        return $this;
    }

    /**
     * Get baiduLink
     *
     * @return string
     */
    public function getBaiduLink()
    {
        return $this->baidu_link;
    }

    /**
     * Set xingLink
     *
     * @param string $xingLink
     *
     * @return User
     */
    public function setXingLink($xingLink)
    {
        $this->xing_link = $xingLink;

        return $this;
    }

    /**
     * Get xingLink
     *
     * @return string
     */
    public function getXingLink()
    {
        return $this->xing_link;
    }
}
