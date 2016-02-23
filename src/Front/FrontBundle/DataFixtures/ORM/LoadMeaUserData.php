<?php

namespace Front\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use User\UserBundle\Entity\User;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;
use Front\FrontBundle\Entity\MeaUser;

class LoadMeaUserData extends AbstractFixture implements OrderedFixtureInterface {

    use FixturesDataTrait;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        shuffle($this->array_user);

        $i = 0;
        foreach ($this->array_user as $user_reference) {
            if ($i == 9)
                break;

            $MeaUser = new MeaUser();
            $MeaUser->setUser($this->getReference('user-' . filter_var($user_reference, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
            $MeaUser->setOrdre(rand(0, 100));
            $locale = $this->array_locale[rand(0, 1)];
            $MeaUser->translate($locale)->setDescription($this->array_description[rand(0, 19)]);
            $manager->persist($MeaUser);
            $MeaUser->mergeNewTranslations();
            $this->addReference('meauser-' . filter_var($user_reference, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $MeaUser);

            $i++;
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 46;
    }

}
