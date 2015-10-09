<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * MeaCity
 *
 * @ORM\Table(name="meacitytranslation")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\MeaCityRepository")
 */
class MeaCityTranslation {

    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * Set description
     *
     * @param string $description
     * @return MeaCity
     */
    public function setDescription($description = null) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set locale
     *
     * @param string $locale
     * @return MeaCityTranslation
     */
    public function setLocale($locale) {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale() {
        return $this->locale;
    }

}
