<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table(name="city")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\CityRepository")
 */
class City {

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @ORM\OneToOne(targetEntity="Front\FrontBundle\Entity\MeaCity", mappedBy="city")
     * */
    private $meaCity;

    public function getEdito() {
        if (!$this->getMeaCity())
            return false;
        return $this->getMeaCity()->getEdito();
    }

    public function hasEdito() {
        if (!$this->getMeaCity())
            return false;
        if ($this->getMeaCity()->getEdito())
            return true;
        return false;
    }
    
    public function getImage() {
        if (!$this->getMeaCity())
            return false;
        return $this->getMeaCity()->getImage();
    }

    public function hasImage() {
        if (!$this->getMeaCity())
            return false;
        if ($this->getMeaCity()->getImage())
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
     * @return City
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
     * Set latitude
     *
     * @param float $latitude
     * @return City
     */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
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
     * @return City
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * Set meaCity
     *
     * @param \Front\FrontBundle\Entity\MeaCity $meaCity
     *
     * @return City
     */
    public function setMeaCity(\Front\FrontBundle\Entity\MeaCity $meaCity = null) {
        $this->meaCity = $meaCity;

        return $this;
    }

    /**
     * Get meaCity
     *
     * @return \Front\FrontBundle\Entity\MeaCity
     */
    public function getMeaCity() {
        return $this->meaCity;
    }

}
