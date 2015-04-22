<?php

namespace User\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * UserType
 *
 * @ORM\Table(name="usertranslation")
 * @ORM\Entity(repositoryClass="User\UserBundle\Entity\UserRepository")
 */
class UserTranslation
{
    
    use ORMBehaviors\Translatable\Translation;


    /** @ORM\Column(name="baseline", type="string", length=255, nullable=true) */
    protected $baseline;
    
    /** @ORM\Column(name="description", type="text", nullable=true) */
    protected $description;
    
    /** @ORM\Column(name="description_short", type="text", nullable=true) */
    protected $description_short;
    
    
     /**
     * Set baseline
     *
     * @param string $baseline
     * @return User
     */
    public function setBaseline($baseline)
    {
        $this->baseline = $baseline;

        return $this;
    }

    /**
     * Get baseline
     *
     * @return string 
     */
    public function getBaseline()
    {
        return $this->baseline;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description_short
     *
     * @param string $descriptionShort
     * @return User
     */
    public function setDescriptionShort($descriptionShort)
    {
        $this->description_short = $descriptionShort;

        return $this;
    }

    /**
     * Get description_short
     *
     * @return string 
     */
    public function getDescriptionShort()
    {
        return $this->description_short;
    }
}
