<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use User\UserBundle\Entity\User;
use Doctrine\Common\Collections\Criteria;

/**
 * MeaUser
 *
 * @ORM\Table(name="meauser")
 * @ORM\Entity(repositoryClass="Front\FrontBundle\Entity\MeaUserRepository")
 */
class MeaUser {

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
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;

    /**
     * @ORM\OneToOne(targetEntity="User\UserBundle\Entity\User", inversedBy="meaUser")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * 
     * */
    protected $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="salsa_discover", type="boolean", nullable=true)
     */
    private $salsaDiscover;

    /**
     * @var integer
     *
     * @ORM\Column(name="bachata_discover", type="boolean", nullable=true)
     */
    private $bachataDiscover;

    /**
     * @var integer
     *
     * @ORM\Column(name="kizomba_discover", type="boolean", nullable=true)
     */
    private $kizombaDiscover;

    /**
     * @var integer
     *
     * @ORM\Column(name="salsa_learn", type="boolean", nullable=true)
     */
    private $salsaLearn;

    /**
     * @var integer
     *
     * @ORM\Column(name="bachata_learn", type="boolean", nullable=true)
     */
    private $bachataLearn;

    /**
     * @var integer
     *
     * @ORM\Column(name="kizomba_learn", type="boolean", nullable=true)
     */
    private $kizombaLearn;

    /**
     * @var integer
     *
     * @ORM\Column(name="salsa_meet", type="boolean", nullable=true)
     */
    private $salsaMeet;

    /**
     * @var integer
     *
     * @ORM\Column(name="bachata_meet", type="boolean", nullable=true)
     */
    private $bachataMeet;

    /**
     * @var integer
     *
     * @ORM\Column(name="kizomba_meet", type="boolean", nullable=true)
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

    public function __toString() {
        if ($this->getUser())
            return $this->getUser()->__toString();
        return (string) $this->ordre;
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
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return MeaUser
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
     * Set user
     *
     * @param \User\UserBundle\Entity\User $user
     *
     * @return MeaUser
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

    /**
     * Set salsaDiscover
     *
     * @param integer $salsaDiscover
     *
     * @return MeaUser
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
     * @return MeaUser
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
     * @return MeaUser
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
     * @return MeaUser
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
     * @return MeaUser
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
     * @return MeaUser
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
     * @return MeaUser
     */
    public function setSalsaMeet($salsaMeet) {
        $this->salsaMeet = $salsaMeet;

        return $this;
    }

    /**
     * Get salsaMeet
     *
     * @return integer
     */
    public function getSalsaMeet() {
        return $this->salsaMeet;
    }

    /**
     * Set bachataMeet
     *
     * @param integer $bachataMeet
     *
     * @return MeaUser
     */
    public function setBachataMeet($bachataMeet) {
        $this->bachataMeet = $bachataMeet;

        return $this;
    }

    /**
     * Get bachataMeet
     *
     * @return integer
     */
    public function getBachataMeet() {
        return $this->bachataMeet;
    }

    /**
     * Set kizombaMeet
     *
     * @param integer $kizombaMeet
     *
     * @return MeaUser
     */
    public function setKizombaMeet($kizombaMeet) {
        $this->kizombaMeet = $kizombaMeet;

        return $this;
    }

    /**
     * Get kizombaMeet
     *
     * @return integer
     */
    public function getKizombaMeet() {
        return $this->kizombaMeet;
    }

}
