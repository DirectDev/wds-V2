<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Admin\AdminBundle\Entity\Page;

/**
 * PageContent
 *
 * @ORM\Table(name="pagecontent")
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Entity\PageContentRepository")
 */
class PageContent {

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
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;
    
    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="PageContents")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     */
    protected $Page;

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
    public function getId() {
        return $this->id;
    }



    /**
     * Set position
     *
     * @param integer $position
     *
     * @return PageContent
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set page
     *
     * @param \Admin\AdminBundle\Entity\Page $page
     *
     * @return PageContent
     */
    public function setPage(\Admin\AdminBundle\Entity\Page $page = null)
    {
        $this->Page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Admin\AdminBundle\Entity\Page
     */
    public function getPage()
    {
        return $this->Page;
    }
}
