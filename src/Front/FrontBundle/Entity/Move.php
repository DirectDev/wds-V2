<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Move
 *
 * @ORM\Table(name="move")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\MoveRepository")
 */
class Move {

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
     * @ORM\ManyToMany(targetEntity="Front\FrontBundle\Entity\Tag", mappedBy="moves", cascade={"persist"})
     */
    protected $tags;

    /**
     * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\User", inversedBy="moves")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\OneToOne(targetEntity="Front\FrontBundle\Entity\Video", inversedBy="move", cascade={"persist"})
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id")
     * 
     * */
    protected $video;

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

    public function __construct() {
        $this->tags = new ArrayCollection();
    }

    public function hasTag($Tag) {
        foreach ($this->getTags() as $moveTag)
            if ($Tag == $moveTag)
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
     * @return Move
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
     * Add tag
     *
     * @param \Front\FrontBundle\Entity\Tag $tag
     *
     * @return Move
     */
    public function addTag(\Front\FrontBundle\Entity\Tag $tag) {
        $this->tags[] = $tag;
        $tag->addMove($this);

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
     * Set user
     *
     * @param \User\UserBundle\Entity\User $user
     *
     * @return Move
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
     * Set video
     *
     * @param \Front\FrontBundle\Entity\Video $video
     *
     * @return Move
     */
    public function setVideo(\Front\FrontBundle\Entity\Video $video = null) {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return \Front\FrontBundle\Entity\Video
     */
    public function getVideo() {
        return $this->video;
    }

}
