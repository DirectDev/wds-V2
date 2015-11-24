<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use User\UserBundle\Entity\User;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Music
 *
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
     * @Assert\NotNull()
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\User", inversedBy="musics")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToMany(targetEntity="Front\FrontBundle\Entity\Tag", mappedBy="musics", cascade={"persist"})
     */
    protected $tags;

    public function __construct() {
        $this->tags = new ArrayCollection();
    }

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

    public function hasTag($Tag) {
        foreach ($this->getTags() as $musicTag)
            if ($Tag == $musicTag)
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

    /**
     * Add tag
     *
     * @param \Front\FrontBundle\Entity\Tag $tag
     *
     * @return Music
     */
    public function addTag(\Front\FrontBundle\Entity\Tag $tag) {
        $this->tags[] = $tag;
        $tag->addMusic($this);

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Front\FrontBundle\Entity\Tag $tag
     */
    public function removeTag(\Front\FrontBundle\Entity\Tag $tag) {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags() {
        return $this->tags;
    }

}
