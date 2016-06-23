<?php

namespace User\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_file")
 * @ORM\Entity(repositoryClass="User\UserBundle\Entity\UserFileRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class UserFile {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userFiles")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    public function getGeneralPath() {
        $entityName = substr(get_class($this), (strrpos(get_class($this), "\\", -1)) + 1);
        $path = __DIR__ . "/../../../../www/uploadedFiles/" . $entityName . '/' . $this->getUser()->getId() . '/';
        return $path;
    }

    public function getGeneralUri() {
        $entityName = substr(get_class($this), (strrpos(get_class($this), "\\", -1)) + 1);
        return "uploadedFiles/" . $entityName . '/' . $this->getUser()->getId() . '/';
    }

    public function getLargePathFile() {
        return $this->getGeneralPath() . 'large/' . $this->name;
    }

    public function getOriginalsPathFile() {
        return $this->getGeneralPath() . 'originals/' . $this->name;
    }
    
//    public function getThumbnailsPathFile() {
//        return $this->getGeneralPath() . 'thumbnails/' . $this->name;
//    }

    public function getLargePathUri() {
        return $this->getGeneralUri() . 'large/' . $this->name;
    }
//    public function getOriginalsPathUri() {
//        return $this->getGeneralUri() . 'originals/' . $this->name;
//    }

    /**
     * @ORM\PreRemove
     */
    public function deleteImage() {
        try {
            if (file_exists($this->getLargePathFile()))
                unlink($this->getLargePathFile());
            if (file_exists($this->getOriginalsPathFile()))
                unlink($this->getOriginalsPathFile());
//            if (file_exists($this->getThumbnailsPathFile()))
//                unlink($this->getThumbnailsPathFile());
        } catch (\Exception $e) {
            
        }
    }

    public function isValid() {
        if (!file_exists($this->getLargePathFile()))
            return false;
        return true;
    }

    public function isImage() {
        if (!preg_match('/(gif|jpg|png)$/i', $this->name))
            return false;
        return true;
    }

    public function getTitle() {
        return $this->getUser()->getUsername();
    }
    
    public function isRelatedToEvent() {
        return false;
    }

    public function isRelatedToUser() {
        return true;
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
     * @return UserFile
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
     * Set user
     *
     * @param \User\UserBundle\Entity\User $user
     * @return UserFile
     */
    public function setUser(\User\UserBundle\Entity\User $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \User\UserBundle\Entity\User 
     */
    public function getUser() {
        return $this->user;
    }

}
