<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Move
 *
 * @ORM\Table(name="movetranslation")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\MoveRepository")
 */
class MoveTranslation
{
    
    use ORMBehaviors\Translatable\Translation;
    

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50)
     */
    private $title;



    /**
     * Set title
     *
     * @param string $title
     * @return Move
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

    /**
     * Set locale
     *
     * @param string $locale
     * @return MoveTranslation
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
    }
}
