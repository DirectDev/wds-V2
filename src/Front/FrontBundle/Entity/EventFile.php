<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="event_file")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\EventFileRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class EventFile {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="eventFiles")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    protected $event;

    public function getGeneralPath() {
        $entityName = substr(get_class($this), (strrpos(get_class($this), "\\", -1)) + 1);
        $path = __DIR__ . "/../../../../www/uploadedFiles/" . $entityName . '/' . $this->getEvent()->getId() . '/';
        return $path;
    }

    public function getGeneralUri() {
        $entityName = substr(get_class($this), (strrpos(get_class($this), "\\", -1)) + 1);
        return "uploadedFiles/" . $entityName . '/' . $this->getEvent()->getId() . '/';
    }

    public function getLargePathFile() {
        return $this->getGeneralPath() . 'large/' . $this->name;
    }

//    public function getOriginalsPathFile() {
//        return $this->getGeneralPath() . 'originals/' . $this->name;
//    }

    public function getLargePathUri() {
        return $this->getGeneralUri() . 'large/' . $this->name;
    }

//    public function getOriginalsPathUri() {
//        return $this->getGeneralUri() . 'originals/' . $this->name;
//    }

    /**
     * @ORM\PreRemove
     */
    public function deleteImage() {
        try {
            if (file_exists($this->getLargePathFile()))
                unlink($this->getLargePathFile());
//            if (file_exists($this->getOriginalsPathFile()))
//                unlink($this->getOriginalsPathFile());
        } catch (\Exception $e) {
            
        }
    }

    public function isValid() {
        if (!file_exists($this->getLargePathFile()))
            return false;
        return true;
    }

    public function isImage() {
        if (!$this->isValid())
            return false;
        if (!preg_match('/(gif|jpg|png)$/i', $this->name))
            return false;
        return true;
    }

    public function getTitle() {
        return $this->getEvent()->getTitle();
    }

    public function isRelatedToEvent() {
        return true;
    }

    public function isRelatedToUser() {
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
     * @return EventFile
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
     * Set event
     *
     * @param \Front\FrontBundle\Entity\Event $event
     * @return EventFile
     */
    public function setEvent(\Front\FrontBundle\Entity\Event $event = null) {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Front\FrontBundle\Entity\Event 
     */
    public function getEvent() {
        return $this->event;
    }

}
