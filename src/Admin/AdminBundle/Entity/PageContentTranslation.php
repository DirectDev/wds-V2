<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Admin\AdminBundle\Entity\PageContent;

/**
 * PageContentTranslation
 *
 * @ORM\Table(name="pagecontenttranslation")
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Entity\PageContentTranslationRepository")
 */
class PageContentTranslation {

    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * Set content
     *
     * @param string $content
     * @return PageContentTranslation
     */
    public function setContent($content = null) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent() {
        return $this->content;
    }

}
