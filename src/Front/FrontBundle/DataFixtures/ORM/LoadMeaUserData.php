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

        $user_reference1 = $user_reference2 = $user_reference3 = $user_reference4 = null;
        for ($i = 0; $i <= 20; $i++) {

            if (!in_array($user_reference1, array($user_reference2, $user_reference3, $user_reference4)) &&
                    !in_array($user_reference2, array($user_reference1, $user_reference3, $user_reference4)) &&
                    !in_array($user_reference3, array($user_reference2, $user_reference1, $user_reference4))
            )
                break;

            $user_reference1 = $this->array_user[rand(0, count($this->array_user) - 1)];
            $user_reference2 = $this->array_user[rand(0, count($this->array_user) - 1)];
            $user_reference3 = $this->array_user[rand(0, count($this->array_user) - 1)];
            $user_reference4 = $this->array_user[rand(0, count($this->array_user) - 1)];
        }

        $MeaUser = new MeaUser();
        $MeaUser->setUser($this->getReference('user-' . $user_reference1));
        $MeaUser->setOrdre(rand(0, 100));
        $locale = $this->array_locale[rand(0, 1)];
        $MeaUser->translate($locale)->setDescription($this->array_description[rand(0, 19)]);
        $manager->persist($MeaUser);
        $MeaUser->mergeNewTranslations();
        $this->addReference('meauser-' . filter_var($user_reference1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $MeaUser);

        $MeaUser = new MeaUser();
        $MeaUser->setUser($this->getReference('user-' . $user_reference2));
        $MeaUser->setOrdre(rand(0, 100));
        $locale = $this->array_locale[rand(0, 1)];
        $MeaUser->translate($locale)->setDescription($this->array_description[rand(0, 19)]);
        $manager->persist($MeaUser);
        $MeaUser->mergeNewTranslations();
        $this->addReference('meauser-' . filter_var($user_reference2, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $MeaUser);

        $MeaUser = new MeaUser();
        $MeaUser->setUser($this->getReference('user-' . $user_reference3));
        $MeaUser->setOrdre(rand(0, 100));
        $locale = $this->array_locale[rand(0, 1)];
        $MeaUser->translate($locale)->setDescription($this->array_description[rand(0, 19)]);
        $manager->persist($MeaUser);
        $MeaUser->mergeNewTranslations();
        $this->addReference('meauser-' . filter_var($user_reference3, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $MeaUser);

        $MeaUser = new MeaUser();
        $MeaUser->setUser($this->getReference('user-' . $user_reference4));
        $MeaUser->setOrdre(rand(0, 100));
        $locale = $this->array_locale[rand(0, 1)];
        $MeaUser->translate($locale)->setDescription($this->array_description[rand(0, 19)]);
        $manager->persist($MeaUser);
        $MeaUser->mergeNewTranslations();
        $this->addReference('meauser-' . filter_var($user_reference4, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $MeaUser);


        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 46;
    }

}
