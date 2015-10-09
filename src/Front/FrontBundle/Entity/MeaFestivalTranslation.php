<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * MeaFestival
 *
 * @ORM\Table(name="meafestivaltranslation")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\MeaFestivalRepository")
 */
class MeaFestivalTranslation {

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
     * @return MeaFestival
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
     * @return MeaFestivalTranslation
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
