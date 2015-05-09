<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use User\UserBundle\Entity\User;

/**
 * Music
 *
 * @ORM\Table()
 * @ORM\Table(name="music")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\MusicRepository")
 */
class Music {

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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\User", inversedBy="musics")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    public function isSoundCloud() {
        if (stripos($this->getUrl(), 'soundcloud') !== false)
            return true;
        return false;
    }

    public function isSpotify() {
        if (stripos($this->getUrl(), 'spotify') !== false)
            return true;
        return false;
    }

    public function getSpotifyURI() {
        if (!$this->isSpotify())
            return;

        $pos = stripos($this->getUrl(), 'spotify.com') + 12;
        $str = substr($this->getUrl(), $pos);
        $tab = explode('/', $str);

        return 'spotify:' . $tab[0] . ':' . $tab[1];
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
     * Set url
     *
     * @param string $url
     * @return Music
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set user
     *
     * @param \User\UserBundle\Entity\User $user
     * @return UserFile
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

}
