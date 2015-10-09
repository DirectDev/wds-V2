<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use User\UserBundle\Entity\User;
use Doctrine\Common\Collections\Criteria;

/**
 * MeaCity
 *
 * @ORM\Table(name="meacity")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\MeaCityRepository")
 */
class MeaCity {

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
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;
    
    /**
     * @ORM\OneToOne(targetEntity="Front\FrontBundle\Entity\City", inversedBy="meaCity")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     * 
     * */
    protected $city;

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
    
    public function getName() {
        return $this->getCity()->getName();        
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
     * Set image
     *
     * @param string $image
     *
     * @return MeaCity
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return MeaCity
     */
    public function setOrdre($ordre) {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre() {
        return $this->ordre;
    }


    /**
     * Set city
     *
     * @param \Front\FrontBundle\Entity\City $city
     *
     * @return MeaCity
     */
    public function setCity(\Front\FrontBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Front\FrontBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }
}
