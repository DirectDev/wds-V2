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

        $pos = strrpos($this->getUrl(), 'watch?v=') + 8;
        if ($pos !== false)
            return substr($this->getUrl(), $pos);

        $pos = strrpos($this->getUrl(), '/') + 1;
        if ($pos !== false)
            return substr($this->getUrl(), $pos);
    }

    public function getDailymotionURI() {
        if (!$this->isDailymotion())
            return;

        $pos = strrpos($this->getUrl(), '/') + 1;
        if ($pos !== false)
            return substr($this->getUrl(), $pos);
    }

    public function getVimeoURI() {
        if (!$this->isVimeo())
            return;

        $pos = strrpos($this->getUrl(), '/') + 1;
        if ($pos !== false)
            return substr($this->getUrl(), $pos);
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
