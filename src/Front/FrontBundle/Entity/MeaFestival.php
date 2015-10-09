<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use User\UserBundle\Entity\User;
use Doctrine\Common\Collections\Criteria;

/**
 * MeaFestival
 *
 * @ORM\Table(name="meafestival")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\MeaFestivalRepository")
 */
class MeaFestival
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
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;
    
    /**
     * @ORM\OneToOne(targetEntity="Front\FrontBundle\Entity\Event", inversedBy="meaFestival")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * 
     * */
    protected $event;
    
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
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return MeaFestival
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set event
     *
     * @param \Front\FrontBundle\Entity\Event $event
     *
     * @return MeaFestival
     */
    public function setEvent(\Front\FrontBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Front\FrontBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }
}
