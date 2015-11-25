<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\TagRepository")
 */
class Tag {

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
     * @ORM\ManyToMany(targetEntity="Front\FrontBundle\Entity\Music", inversedBy="tags", cascade={"persist"})
     * @ORM\JoinTable(name="music_tag",
     * joinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="music_id", referencedColumnName="id")}
     * )
     */
    protected $musics;

    /**
     * @ORM\ManyToMany(targetEntity="Front\FrontBundle\Entity\Video", inversedBy="tags", cascade={"persist"})
     * @ORM\JoinTable(name="video_tag",
     * joinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="video_id", referencedColumnName="id")}
     * )
     */
    protected $videos;

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
        $this->moves = new ArrayCollection();
        $this->musics = new ArrayCollection();
        $this->videos = new ArrayCollection();
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
     * @return Tag
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
     * Add music
     *
     * @param \Front\FrontBundle\Entity\Music $music
     *
     * @return Tag
     */
    public function addMusic(\Front\FrontBundle\Entity\Music $music) {
        $this->musics[] = $music;

        return $this;
    }

    /**
     * Remove music
     *
     * @param \Front\FrontBundle\Entity\Music $music
     */
    public function removeMusic(\Front\FrontBundle\Entity\Music $music) {
        $this->musics->removeElement($music);
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
     * Add video
     *
     * @param \Front\FrontBundle\Entity\Video $video
     *
     * @return Tag
     */
    public function addVideo(\Front\FrontBundle\Entity\Video $video) {
        $this->videos[] = $video;

        return $this;
    }

    /**
     * Remove video
     *
     * @param \Front\FrontBundle\Entity\Video $video
     */
    public function removeVideo(\Front\FrontBundle\Entity\Video $video) {
        $this->videos->removeElement($video);
    }

    /**
     * Get videos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVideos() {
        return $this->videos;
    }

}
