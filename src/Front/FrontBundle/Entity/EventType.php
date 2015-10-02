<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EventType
 *
 * @ORM\Table(name="eventtype")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\EventTypeRepository")
 */
class EventType {

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
     * @ORM\ManyToMany(targetEntity="Event", mappedBy="eventTypes", cascade={"persist"})
     */
    protected $events;

    public function __construct() {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getTitle() {
        return $this->__call('getTitle', array());
    }

    public function __toString() {
        if ($this->getTitle())
            return $this->getTitle();
        return $this->getName();
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
     * @return EventType
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
     * Add event
     *
     * @param \Front\FrontBundle\Entity\Event $event
     *
     * @return EventType
     */
    public function addEvent(\Front\FrontBundle\Entity\Event $event) {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \Front\FrontBundle\Entity\Event $event
     */
    public function removeEvent(\Front\FrontBundle\Entity\Event $event) {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents() {
        return $this->events;
    }

}
