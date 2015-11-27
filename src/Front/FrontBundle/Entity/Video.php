<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\VideoRepository")
 */
class Video {

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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="move", type="boolean", nullable=true)
     */
    private $move;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\User", inversedBy="videos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToMany(targetEntity="Front\FrontBundle\Entity\Tag", mappedBy="videos", cascade={"persist"})
     */
    protected $tags;

    /**
     * @ORM\ManyToMany(targetEntity="User\UserBundle\Entity\User", mappedBy="videoloves")     
     * */
    private $lovesMe;

    public function __construct() {
        $this->tags = new ArrayCollection();
        $this->lovesMe = new ArrayCollection();
    }

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

    public function __toString() {
        return $this->getTitle();
    }

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

    public function hasTag($Tag) {
        foreach ($this->getTags() as $videoTag)
            if ($Tag == $videoTag)
                return true;
        return false;
    }

    public function getTagsText() {
        $text = '';
        foreach ($this->getTags() as $videoTag)
            $text .= ' ' . $videoTag->getTitle();
        return $text;
    }
    
    public function countLoves(){
        return count($this->lovesMe);
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

    /**
     * Add tag
     *
     * @param \Front\FrontBundle\Entity\Tag $tag
     *
     * @return Video
     */
    public function addTag(\Front\FrontBundle\Entity\Tag $tag) {
        $this->tags[] = $tag;
        $tag->addVideo($this);

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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Video
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
     * Set move
     *
     * @param boolean $move
     *
     * @return Video
     */
    public function setMove($move) {
        $this->move = $move;

        return $this;
    }

    /**
     * Get move
     *
     * @return boolean
     */
    public function getMove() {
        return $this->move;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Video
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Add lovesMe
     *
     * @param \User\UserBundle\Entity\User $lovesMe
     *
     * @return Video
     */
    public function addLovesMe(\User\UserBundle\Entity\User $lovesMe) {
        $this->lovesMe[] = $lovesMe;
        $lovesMe->addVideolove($this);


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

}
