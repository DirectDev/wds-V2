<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Admin\AdminBundle\Entity\PageContent;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Entity\PageRepository")
 */
class Page {

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="PageContent", mappedBy="Page", cascade={"persist", "remove"})     
     * @ORM\OrderBy({"position" = "ASC"})     
     */
    protected $PageContents;

    /**
     * Constructor
     */
    public function __construct() {
        $this->PageContents = new \Doctrine\Common\Collections\ArrayCollection();
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
    
    public function getAllContent() {
        $result = null;
        foreach($this->getPageContents() as $PageContent)
            $result .= $PageContent->getContent();
        return $result;
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
     * @return Page
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
     * Add pageContent
     *
     * @param \Admin\AdminBundle\Entity\PageContent $pageContent
     *
     * @return Page
     */
    public function addPageContent(\Admin\AdminBundle\Entity\PageContent $pageContent)
    {
        $this->PageContents[] = $pageContent;

        return $this;
    }

    /**
     * Remove pageContent
     *
     * @param \Admin\AdminBundle\Entity\PageContent $pageContent
     */
    public function removePageContent(\Admin\AdminBundle\Entity\PageContent $pageContent)
    {
        $this->PageContents->removeElement($pageContent);
    }

    /**
     * Get pageContents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPageContents()
    {
        return $this->PageContents;
    }
}
