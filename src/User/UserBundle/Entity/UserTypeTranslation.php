<?php

namespace User\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * UserType
 *
 * @ORM\Table(name="usertypetranslation")
 * @ORM\Entity(repositoryClass="User\UserBundle\Entity\UserTypeRepository")
 */
class UserTypeTranslation
{
    
    use ORMBehaviors\Translatable\Translation;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $title;


    /**
     * Set title
     *
     * @param string $title
     * @return UserType
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}
