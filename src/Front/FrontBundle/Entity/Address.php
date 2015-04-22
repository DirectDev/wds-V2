<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use User\UserBundle\Entity\User;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\AddressRepository")
 */
class Address {

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
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="street_complement", type="string", length=255, nullable=true)
     */
    private $streetComplement;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=20, nullable=true)
     */
    private $postcode;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", nullable=true)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", nullable=true)
     */
    private $longitude;

    /**
     * @ORM\ManyToMany(targetEntity="Event", inversedBy="addresses", cascade={"persist"})
     * @ORM\JoinTable(name="event_address",
     * joinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="event_id", referencedColumnName="id")}
     * )
     */
    protected $events;

    /**
     * @ORM\ManyToMany(targetEntity="User\UserBundle\Entity\User", inversedBy="addresses", cascade={"persist"})
     * @ORM\JoinTable(name="user_address",
     * joinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    protected $users;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="addresses")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * */
    protected $country;

    public function __toString() {
        if ($this->getName())
            return $this->getName();
        return trim($this->getStreet() . ' ' . $this->getStreetComplement() . ' ' . $this->getPostcode() . ' ' . $this->getCity());
    }

    public function getFullAddress() {
        $array = array();
        if ($this->name)
            $array[] = ucfirst($this->name);
        if ($this->street)
            $array[] = ucfirst($this->street);
        if ($this->streetComplement)
            $array[] = ucfirst($this->streetComplement);
        if ($this->postcode)
            $array[] = ucfirst($this->postcode);
        if ($this->city)
            $array[] = ucfirst($this->city);
        if ($this->getCountry())
            $array[] = ucfirst($this->getCountry());

        return trim(implode(', ', $array));
    }

    public function stringForGoogleMaps() {
        $string = '';
        if ($this->street)
            $string .= $this->street;
        if ($this->streetComplement)
            $string .= ', ' . $this->streetComplement;
        if ($this->postcode)
            $string .= ', ' . $this->postcode;
        if ($this->city)
            $string .= ', ' . $this->city;
        if ($this->getCountry())
            $string .= ', ' . $this->getCountry();

        return trim($string);
    }

    public function isValid() {
        if (!$this->getLatitude())
            return false;
        if (!$this->getLongitude())
            return false;

        return true;
    }

    public function getEvent() {
        foreach ($this->events as $event) {
            return $event;
        }
    }

    public function getUser() {
        foreach ($this->users as $user) {
            return $user;
        }
        foreach ($this->events as $event) {
            return $event->getUser();
        }
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Address
     */
    public function setName($name = null) {
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
     * Add events
     *
     * @param \Front\FrontBundle\Entity\Event $events
     * @return Address
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
     * Set country
     *
     * @param \Front\FrontBundle\Entity\Country $country
     * @return Address
     */
    public function setCountry(\Front\FrontBundle\Entity\Country $country = null) {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Front\FrontBundle\Entity\Country 
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street = null) {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * Set streetComplement
     *
     * @param string $streetComplement
     * @return Address
     */
    public function setStreetComplement($streetComplement = null) {
        $this->streetComplement = $streetComplement;

        return $this;
    }

    /**
     * Get streetComplement
     *
     * @return string 
     */
    public function getStreetComplement() {
        return $this->streetComplement;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city) {
        $this->city = $city;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return Address
     */
    public function setPostcode($postcode = null) {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getPostcode() {
        return $this->postcode;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return Address
     */
    public function setLatitude($latitude = null) {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get street
     *
     * @return float 
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return Address
     */
    public function setLongitude($longitude = null) {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get street
     *
     * @return float 
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * Add users
     *
     * @param \User\UserBundle\Entity\User $users
     * @return Address
     */
    public function addUser(\User\UserBundle\Entity\User $users) {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \User\UserBundle\Entity\User $users
     */
    public function removeUser(\User\UserBundle\Entity\User $users) {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers() {
        return $this->users;
    }

}
