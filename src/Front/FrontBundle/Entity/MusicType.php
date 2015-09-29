<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use User\UserBundle\Entity\User;

/**
 * MusicType
 *
 * @ORM\Table(name="musictype")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\MusicTypeRepository")
 */
class MusicType
{
    
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
     * @ORM\ManyToMany(targetEntity="Event", mappedBy="musicTypes", cascade={"persist"})
     */
    protected $events;
    
    /**
     * @ORM\ManyToMany(targetEntity="User\UserBundle\Entity\User", mappedBy="musicTypes", cascade={"persist"})
     */
    protected $users;
    
    
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
    
    public function __construct() {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString(){
        if($this->getTitle())
            return $this->getTitle();
        return $this->getName();
    }
    
    public function getHomeImagePathUri(){
        return  "images/MusicType/HomeImage/".$this->name.'_750x340.gif';
    }
    
    public function getTitle(){
        return $this->__call('getTitle', array());
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return MusicType
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

    /**
     * Add events
     *
     * @param \Front\FrontBundle\Entity\Event $events
     * @return MusicType
     */
    public function addEvent(\Front\FrontBundle\Entity\Event $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \Front\FrontBundle\Entity\Event $events
     */
    public function removeEvent(\Front\FrontBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add users
     *
     * @param \User\UserBundle\Entity\User $users
     * @return MusicType
     */
    public function addUser(\User\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \User\UserBundle\Entity\User $users
     */
    public function removeUser(\User\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
