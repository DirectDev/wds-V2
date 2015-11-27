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
     * @Assert\NotNull()
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\User", inversedBy="musics")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToMany(targetEntity="Front\FrontBundle\Entity\Tag", mappedBy="musics", cascade={"persist"})
     */
    protected $tags;

    /**
     * @ORM\ManyToMany(targetEntity="User\UserBundle\Entity\User", mappedBy="musicloves")     
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

    public function getTagsText() {
        $text = '';
        foreach ($this->getTags() as $musicTag)
            $text .= ' ' . $musicTag->getTitle();
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

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Music
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
     * @return Music
     */
    public function addLovesMe(\User\UserBundle\Entity\User $lovesMe) {
        $lovesMe->addMusiclove($this);
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
     * Set name
     *
     * @param string $name
     *
     * @return Music
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
