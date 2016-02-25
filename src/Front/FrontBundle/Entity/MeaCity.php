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

    /**
     * @var integer
     *
     * @ORM\Column(name="salsa_discover", type="integer", nullable=true)
     */
    private $salsaDiscover;

    /**
     * @var integer
     *
     * @ORM\Column(name="bachata_discover", type="integer", nullable=true)
     */
    private $bachataDiscover;

    /**
     * @var integer
     *
     * @ORM\Column(name="kizomba_discover", type="integer", nullable=true)
     */
    private $kizombaDiscover;

    /**
     * @var integer
     *
     * @ORM\Column(name="salsa_learn", type="integer", nullable=true)
     */
    private $salsaLearn;

    /**
     * @var integer
     *
     * @ORM\Column(name="bachata_learn", type="integer", nullable=true)
     */
    private $bachataLearn;

    /**
     * @var integer
     *
     * @ORM\Column(name="kizomba_learn", type="integer", nullable=true)
     */
    private $kizombaLearn;

    /**
     * @var integer
     *
     * @ORM\Column(name="salsa_meet", type="integer", nullable=true)
     */
    private $salsaMeet;

    /**
     * @var integer
     *
     * @ORM\Column(name="bachata_meet", type="integer", nullable=true)
     */
    private $bachataMeet;

    /**
     * @var integer
     *
     * @ORM\Column(name="kizomba_meet", type="integer", nullable=true)
     */
    private $kizombaMeet;

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
    public function setCity(\Front\FrontBundle\Entity\City $city = null) {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Front\FrontBundle\Entity\City
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set salsaDiscover
     *
     * @param integer $salsaDiscover
     *
     * @return MeaCity
     */
    public function setSalsaDiscover($salsaDiscover) {
        $this->salsaDiscover = $salsaDiscover;

        return $this;
    }

    /**
     * Get salsaDiscover
     *
     * @return integer
     */
    public function getSalsaDiscover() {
        return $this->salsaDiscover;
    }

    /**
     * Set bachataDiscover
     *
     * @param integer $bachataDiscover
     *
     * @return MeaCity
     */
    public function setBachataDiscover($bachataDiscover) {
        $this->bachataDiscover = $bachataDiscover;

        return $this;
    }

    /**
     * Get bachataDiscover
     *
     * @return integer
     */
    public function getBachataDiscover() {
        return $this->bachataDiscover;
    }

    /**
     * Set kizombaDiscover
     *
     * @param integer $kizombaDiscover
     *
     * @return MeaCity
     */
    public function setKizombaDiscover($kizombaDiscover) {
        $this->kizombaDiscover = $kizombaDiscover;

        return $this;
    }

    /**
     * Get kizombaDiscover
     *
     * @return integer
     */
    public function getKizombaDiscover() {
        return $this->kizombaDiscover;
    }

    /**
     * Set salsaLearn
     *
     * @param integer $salsaLearn
     *
     * @return MeaCity
     */
    public function setSalsaLearn($salsaLearn) {
        $this->salsaLearn = $salsaLearn;

        return $this;
    }

    /**
     * Get salsaLearn
     *
     * @return integer
     */
    public function getSalsaLearn() {
        return $this->salsaLearn;
    }

    /**
     * Set bachataLearn
     *
     * @param integer $bachataLearn
     *
     * @return MeaCity
     */
    public function setBachataLearn($bachataLearn) {
        $this->bachataLearn = $bachataLearn;

        return $this;
    }

    /**
     * Get bachataLearn
     *
     * @return integer
     */
    public function getBachataLearn() {
        return $this->bachataLearn;
    }

    /**
     * Set kizombaLearn
     *
     * @param integer $kizombaLearn
     *
     * @return MeaCity
     */
    public function setKizombaLearn($kizombaLearn) {
        $this->kizombaLearn = $kizombaLearn;

        return $this;
    }

    /**
     * Get kizombaLearn
     *
     * @return integer
     */
    public function getKizombaLearn() {
        return $this->kizombaLearn;
    }


    /**
     * Set salsaMeet
     *
     * @param integer $salsaMeet
     *
     * @return MeaCity
     */
    public function setSalsaMeet($salsaMeet)
    {
        $this->salsaMeet = $salsaMeet;

        return $this;
    }

    /**
     * Get salsaMeet
     *
     * @return integer
     */
    public function getSalsaMeet()
    {
        return $this->salsaMeet;
    }

    /**
     * Set bachataMeet
     *
     * @param integer $bachataMeet
     *
     * @return MeaCity
     */
    public function setBachataMeet($bachataMeet)
    {
        $this->bachataMeet = $bachataMeet;

        return $this;
    }

    /**
     * Get bachataMeet
     *
     * @return integer
     */
    public function getBachataMeet()
    {
        return $this->bachataMeet;
    }

    /**
     * Set kizombaMeet
     *
     * @param integer $kizombaMeet
     *
     * @return MeaCity
     */
    public function setKizombaMeet($kizombaMeet)
    {
        $this->kizombaMeet = $kizombaMeet;

        return $this;
    }

    /**
     * Get kizombaMeet
     *
     * @return integer
     */
    public function getKizombaMeet()
    {
        return $this->kizombaMeet;
    }
}
