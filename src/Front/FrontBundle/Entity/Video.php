<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\VideoRepository")
 */
class Video {

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
     * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\User", inversedBy="videos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    public function isVimeo() {
        if (stripos($this->getUrl(), 'vimeo') !== false)
            return true;
        return false;
    }

    public function isDailymotion() {
        if (stripos($this->getUrl(), 'dailymotion') !== false)
            return true;
        return false;
    }

    public function isYoutube() {
        if (stripos($this->getUrl(), 'youtube') !== false)
            return true;
        return false;
    }

    public function getYoutubeURI() {
        if (!$this->isYoutube())
            return;

        $pos = stripos($this->getUrl(), 'youtube.com') + 12;
        $str = substr($this->getUrl(), $pos);
        $tab = explode('/', $str);

        return $tab[1];
    }

    public function getDailymotionURI() {
        if (!$this->isYoutube())
            return;

        $pos = stripos($this->getUrl(), 'dailymotion.com') + 16;
        $str = substr($this->getUrl(), $pos);
        $tab = explode('/', $str);

        return $tab[1];
    }

    public function getVimeoURI() {
        if (!$this->isYoutube())
            return;

        $pos = stripos($this->getUrl(), 'vimeo.com') + 10;
        $str = substr($this->getUrl(), $pos);
        $tab = explode('/', $str);

        return $tab[1];
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
     * @return Video
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
